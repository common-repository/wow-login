<?php
	/**
		* Google
		*
		* @package     
		* @subpackage  Integration
		* @copyright   Copyright (c) 2017, Dmytro Lobov
		* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
		* @since       1.0
	*/
	
	if ( ! defined( 'ABSPATH' ) ) exit;
	
	include('google/Client.php' );
    include('google/Service/Plus.php' );
	
	// $post = $_POST;
	// $get = $_GET;
	// $request = $_REQUEST;
	// $site = self::siteUrl();
	$callBackUrl = self::callBackUrl();
	
	$param = $this->option;
	
	$response = new stdClass();
	$action = isset( $_GET['action'] ) ? sanitize_text_field($_GET['action']) : '';
	
	$client_id = $param['google_client_id'];
	$client_secret = $param['google_client_secret'];
	
	$encoded_url = isset( $_GET['redirect_to'] ) ? esc_url($_GET['redirect_to']) : '';	
	if (!empty($encoded_url)){
		set_site_transient( 'wow_login_google_redirect', $encoded_url, 60);	
	}
	else {
		$redirect = get_site_transient( 'wow_login_google_redirect'); 
		
	}
	
	if( isset( $encoded_url ) && $encoded_url != '' ) {
		$callback = $callBackUrl . 'wowLogin' . '=google';
	} 
	else {
		$callback = $callBackUrl . 'wowLogin' . '=google';
	}
	
	$redirect_uri = $callback;
	
	$client = new Google_Client;
	$client->setClientId( $client_id );
	$client->setClientSecret( $client_secret );
	$client->setRedirectUri( $redirect_uri );
	$client->addScope( "https://www.googleapis.com/auth/plus.profile.emails.read" );
	if( isset( $encoded_url ) && $encoded_url != '' ) {
		$client->setState(  "redirect_to=$encoded_url" );
	}
	
	$service = new Google_Service_Plus( $client );
	
	if( $action == 'login' ) {
		unset($_SESSION['access_token']);
		// Get identity from user and redirect browser to OpenID Server
		if( !( isset( $_SESSION['access_token'] ) && $_SESSION['access_token'] ) ) {
			$authUrl = $client->createAuthUrl();
			self:: redirect( $authUrl );
			die();
		} 
		else {			
			self:: redirect( $redirect_uri."&redirect_to=$encoded_url" );
			die();
		}
	} 
	elseif( isset( $_GET['code'] ) ) {
		// Perform HTTP Request to OpenID server to validate key
		$client->authenticate( $_GET['code'] );
		$_SESSION['access_token'] = $client->getAccessToken();		
		self:: redirect( $redirect_uri."&redirect_to=".$redirect );
		die();
	} 
	elseif( isset( $_SESSION['access_token'] ) && $_SESSION['access_token'] ) {
		$client->setAccessToken( $_SESSION['access_token'] );
		try {
			$user = $service->people->get( "me", array() );
		}
		catch( Exception $fault ) {
			unset( $_SESSION['access_token'] );
			$ref_object = self:: accessProtected( $fault, 'errors' );
			echo $ref_object[0]['message'] . " Please notify about this error to the Site Admin.";
			die();
		}
		
		if( !empty( $user ) ) {
			if( !empty( $user->emails ) ) {								
				$identifier = isset($user->id) ? $user->id : '';			
				$email = $user->emails[0]->value;
				$fname = $user->name->givenName;
				$lname = $user->name->familyName;	
				$name = strtolower($user->name->givenName);
				$link = isset($user->url) ? $user->url : '';
				$avatar = substr($user->image->url,0,strpos($user->image->url."?sz=","?sz=")) . '?sz=450';
				$data = array(
				'identifier' => $identifier,
				'name'       => $name,
				'EMAIL'      => $email,
				'FNAME'      => $fname,
				'LNAME'      => $lname,						
				'link'       => $link,					
				'type'       => 'google',
				'avatar'     => $avatar,
				);
				
				self::wow_login($data);	
			}
			else {
				$response->status = 'ERROR';
				$response->error_code = 2;
				$response->error_message = "INVALID AUTHORIZATION";
			}
		} 
		else {
			// Signature Verification Failed
			$response->status = 'ERROR';
			$response->error_code = 2;
			$response->error_message = "INVALID AUTHORIZATION";
		}
		self:: redirect( $_GET['redirect_to'] );
	} 
	elseif( $_GET['openid_mode'] == 'cancel' ) {
		// User Canceled your Request
		$response->status = 'ERROR';
		$response->error_code = 1;
		$response->error_message = "USER CANCELED REQUEST";
	} 
	else {
		// User failed to login
		$response->status = 'ERROR';
		$response->error_code = 3;
		$response->error_message = "USER LOGIN FAIL";
	}
	
