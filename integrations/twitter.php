<?php
	/**
		* Twitter
		*
		* @package     
		* @subpackage  Integration
		* @copyright   Copyright (c) 2017, Dmytro Lobov
		* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
		* @since       1.0
	*/
	
	if ( ! defined( 'ABSPATH' ) ) exit;
	
	if( !class_exists( 'TwitterOAuth' ) ) {
		include( 'twitter/OAuth.php' );
		include( 'twitter/twitteroauth.php' );
	}
	
	$param = $this->option;
	$request = $_REQUEST;	
	$callBackUrl = self::callBackUrl();
	$action = isset( $_GET['action'] ) ? sanitize_text_field($_GET['action']) : '';
	
	@session_start();
	if( $action == 'login' ) {
		
		// Get identity from user and redirect browser to OpenID Server
		if( !isset( $request['oauth_token'] ) || $request['oauth_token'] == '' ) {
			$twitterObj = new TwitterOAuth( $param['twitter_api_key'], $param['twitter_api_secret'] );
			$encoded_url = isset( $_GET['redirect_to'] ) ? esc_url($_GET['redirect_to']) : '';
			if( isset( $encoded_url ) && $encoded_url != '' ) {				
				$callback = $callBackUrl . 'wowLogin' . '=twitter&redirect_to=' . $encoded_url;
			} 
			else {				
				$callback = $callBackUrl . 'wowLogin' . '=twitter';
			}
			
			$request_token = $twitterObj->getRequestToken( $callback );
			$_SESSION['oauth_twitter'] = array();
			
			/* Save temporary credentials to session. */
			$_SESSION['oauth_twitter']['oauth_token'] = $token = $request_token['oauth_token'];
			$_SESSION['oauth_twitter']['oauth_token_secret'] = $request_token['oauth_token_secret'];
			
			/* If last connection failed don't display authorization link. */
			switch( $twitterObj->http_code ) {
				case 200:
				try {
					$url = $twitterObj->getAuthorizeUrl( $token );
					self:: redirect( $url );
				}
				catch( Exception $e ) {
					$response->status = 'ERROR';
					$response->error_code = 2;
					$response->error_message = 'Could not get AuthorizeUrl.';
				}
				break;
				
				default:
				$response->status = 'ERROR';
				$response->error_code = 2;
				$response->error_message = 'Could not connect to Twitter. Refresh the page or try again later.';
				break;
			}
		} 
		else {
			$response->status = 'ERROR';
			$response->error_code = 2;
			$response->error_message = 'INVALID AUTHORIZATION';
		}
	} 	
	else if( isset( $request['oauth_token'] ) && isset( $request['oauth_verifier'] ) ) {
		
		$redirect = isset( $_GET['redirect_to'] ) ? esc_url($_GET['redirect_to']) : '';		
		/* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
		$twitterObj = new TwitterOAuth( $param['twitter_api_key'], $param['twitter_api_secret'], $_SESSION['oauth_twitter']['oauth_token'], $_SESSION['oauth_twitter']['oauth_token_secret'] );
		
		/* Remove no longer needed request tokens */
		unset( $_SESSION['oauth_twitter'] );
		try {
			$access_token = $twitterObj->getAccessToken( $request['oauth_verifier'] );
			
			/* If HTTP response is 200 continue otherwise send to connect page to retry */
			if( 200 == $twitterObj->http_code ) {
				$user_profile = $twitterObj->get( "account/verify_credentials", array(			    
				'include_email' => 'true',
				) );			
				
				$name = explode( ' ', $user_profile->name, 2 );
				$fname = $name[0];
				$lname =( isset( $name[1] ) ) ? $name[1] : '';
				$email = $user_profile->email;	
				$username = strtolower($user_profile->screen_name);				
				$identifier = $user_profile->id;				
				$link = $user_profile->url;
				$avatar = $user_profile->profile_image_url_https;
				$data = array(
				'identifier' => $identifier,
				'name'       => $username,
				'EMAIL'      => $email,
				'FNAME'      => $fname,
				'LNAME'      => $lname,						
				'link'       => $link,					
				'type'       => 'twitter',	
				'avatar'     => $avatar,
				);
				
				self::wow_login($data);
				
				
			} 
			else {
				$response->status = 'ERROR';
				$response->error_code = 2;
				$response->error_message = 'Could not connect to Twitter. Refresh the page or try again later.';
			}
		}
		catch( Exception $e ) {
			$response->status = 'ERROR';
			$response->error_code = 2;
			$response->error_message = 'Could not get AccessToken.';
		}		
		self:: redirect( $redirect );
	} 		