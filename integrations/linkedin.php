<?php
	/**
		* LinkedIn
		*
		* @package     
		* @subpackage  Integration
		* @copyright   Copyright (c) 2017, Dmytro Lobov
		* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
		* @since       1.0
	*/
	
	if ( ! defined( 'ABSPATH' ) ) exit;
	
	include( 'linkedin/linkedin_class.php' );
	if( !class_exists( 'OAuthException' ) ) {
		include( 'linkedin/OAuth.php' );
	}
	
	// $post = $_POST;
	$get = $_GET;
	// $request = $_REQUEST;
	// $site = self::siteUrl();
	$callBackUrl = self::callBackUrl();
	
	$response = new stdClass();
	$action = isset( $_GET['action'] ) ? sanitize_text_field($_GET['action']) : '';
	$param = $this->option;
	
	$encoded_url = isset( $_GET['redirect_to'] ) ? esc_url($_GET['redirect_to']) : '';
	if( isset( $encoded_url ) && $encoded_url != '' ) {
		$callback = $callBackUrl . 'wowLogin' . '=linkedin&redirect_to=' . $encoded_url;
	} 
	else {
		$callback = $callBackUrl . 'wowLogin' . '=linkedin';
	}
	
	$config = array(
	'appKey' => $param['linkedin_client_id'],
	'appSecret' => $param['linkedin_client_secret'],
	'callbackUrl' => $callback
	);
	@session_start();
	$OBJ_linkedin = new LinkedIn( $config );
	if( $action == 'login' ) {
		
		// send a request for a LinkedIn access token
		$response_server = $OBJ_linkedin->retrieveTokenRequest( array(
		'scope' => 'r_emailaddress'
		) );
		if( $response_server['success'] === TRUE ) {
			$_SESSION['oauth_linkedin'] = $response_server['linkedin'];
			
			// redirect the user to the LinkedIn authentication/authorisation page to initiate validation.
			self:: redirect( LINKEDIN::_URL_AUTH . $response_server['linkedin']['oauth_token'] );
		} 
		else {
			$response->status = 'ERROR';
			$response->error_code = 1;
			$response->error_message = 'Request token retrieval failed';
		}
	} 
	elseif( isset( $_GET['oauth_verifier'] ) ) {
		
		// LinkedIn has sent a response, user has granted permission, take the temp access token, the user's secret and the verifier to request the user's real secret key
		$response1 = $OBJ_linkedin->retrieveTokenAccess( $_SESSION['oauth_linkedin']['oauth_token'], $_SESSION['oauth_linkedin']['oauth_token_secret'], $_GET['oauth_verifier'] );
		
		if( $response1['success'] === TRUE ) {
			$OBJ_linkedin->setTokenAccess( $response1['linkedin'] );
			$OBJ_linkedin->setResponseFormat( LINKEDIN::_RESPONSE_JSON );
			$response2 = $OBJ_linkedin->profile( '~:(id,email-address,first-name,last-name,picture-url,headline,location,summary,public-profile-url)' );
			
			if( $response2['success'] === TRUE ) {
				$data = json_decode( $response2['linkedin'] );
				$identifier = $data->id;
				
				$email = $data->emailAddress;
				$fname = $data->firstName;
				$lname = $data->lastName;			
				$name = $fname.' '.$lname;
				$link = $data->publicProfileUrl;
				$avatar = $data->pictureUrl;
				$data = array(
				'identifier' => $identifier,
				'name'       => $name,
				'EMAIL'      => $email,
				'FNAME'      => $fname,
				'LNAME'      => $lname,						
				'link'       => $link,					
				'type'       => 'linkedin',	
				'avatar'     => $avatar,
				);
				
				self::wow_login($data);
			} 
			else {
				$response->status = 'ERROR';
				$response->error_code = 2;
				$response->error_message = 'Error retrieving profile information';
			}
		} 
		else {
			$response->status = 'ERROR';
			$response->error_code = 1;
			$response->error_message = 'Access token retrieval failed';
		}
	} 
	else {
		$response->status = 'ERROR';
		$response->error_code = 1;
		if( isset( $get['oauth_problem'] ) && $get['oauth_problem'] == 'user_refused' ) {
			$response->error_message = 'Access token retrieval failed';
		} 
		else {
			$response->error_message = 'Request cancelled by user!';
		}
	}
	
	self:: redirect( $encoded_url );
