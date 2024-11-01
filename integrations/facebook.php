<?php
	/**
		* Facebook
		*
		* @package     
		* @subpackage  Integration
		* @copyright   Copyright (c) 2017, Dmytro Lobov
		* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
		* @since       1.0
	*/
	
	if ( ! defined( 'ABSPATH' ) ) exit;
	
	// $request = $_REQUEST;
	// $site = self::siteUrl();
	$callBackUrl = self::callBackUrl();
	
	// $response = new stdClass();
	// $return_user_details = new stdClass();
	
	$action = isset( $_GET['action'] ) ? sanitize_text_field($_GET['action']) : '';
	
	$param = $this->option;
	
	$config = array(
	'app_id' => $param['facebook_api_id'],
	'app_secret' => $param['facebook_secret'],
	'default_graph_version' => 'v2.4'
	);
	
	include (plugin_dir_path( __FILE__ ) . 'facebook/autoload.php');
	$fb = new Facebook\Facebook( $config );
	
	$encoded_url = isset( $_GET['redirect_to'] ) ? esc_url($_GET['redirect_to']) : '';
	
	if( isset( $encoded_url ) && $encoded_url != '' ) {
		$callback = $callBackUrl . 'wowLogin' . '=facebook&redirect_to=' . $encoded_url;
	} 
	else {
		$callback = $callBackUrl . 'wowLogin' . '=facebook';
	}
	
	if( $action == 'login' ) {
		
		// Well looks like we are a fresh dude, login to Facebook!
		$helper = $fb->getRedirectLoginHelper();
		$permissions = array(
		'email',
		'public_profile'
		);
		// optional
		$loginUrl = $helper->getLoginUrl( $callback, $permissions );
		self:: redirect( $loginUrl );
	}
	else {
		if( isset( $_REQUEST['error'] ) ) {
			$response->status = 'ERROR';
			$response->error_code = 2;
			$response->error_message = 'INVALID AUTHORIZATION';
			return $response;
			die();
		}
		if( isset( $_REQUEST['code'] ) ) {
			$helper = $fb->getRedirectLoginHelper();
			// Trick below will avoid "Cross-site request forgery validation failed. Required param "state" missing." from Facebook
			$_SESSION['FBLOGIN_state'] = $_REQUEST['state'];
			try {
				$accessToken = $helper->getAccessToken();
			}
			catch( Facebook\Exceptions\FacebookResponseException $e ) {
				
				// When Graph returns an error
				echo 'Graph returned an error: ' . $e->getMessage();
				exit;
			}
			catch( Facebook\Exceptions\FacebookSDKException $e ) {
				
				// When validation fails or other local issues
				echo 'Facebook SDK returned an error: ' . $e->getMessage();
				exit;
			}
			
			if( isset( $accessToken ) ) {
				
				// Logged in!
				$_SESSION['facebook_access_token'] = (string)$accessToken;
				$fb->setDefaultAccessToken( $accessToken );
				
				try {
					// $response = $fb->get( '/me?fields=email,name, first_name, last_name, gender, link, about, address, bio, birthday, education, hometown, is_verified, languages, location, website' );
					$response = $fb->get( '/me?fields=id,name,email,first_name,last_name,link');
					$userNode = $response->getGraphUser();
				}
				catch( Facebook\Exceptions\FacebookResponseException $e ) {
					
					// When Graph returns an error
					echo 'Graph returned an error: ' . $e->getMessage();
					exit;
				}
				catch( Facebook\Exceptions\FacebookSDKException $e ) {
					
					// When validation fails or other local issues
					echo 'Facebook SDK returned an error: ' . $e->getMessage();
					exit;
				}
				
				$user_profile = self:: access_protected( $userNode, 'items' );
				if( $user_profile != null ) {
					$identifier = isset($user_profile['id']) ? $user_profile['id'] : '';
					$name = isset($user_profile['name']) ? $user_profile['name'] : '';
					$email = isset($user_profile['email']) ? $user_profile['email'] : '';
					$fname = isset($user_profile['first_name']) ? $user_profile['first_name'] : '';
					$lname = isset($user_profile['last_name']) ? $user_profile['last_name'] : '';
					$link = isset($user_profile['link']) ? $user_profile['link'] : '';	
					$avatar = 'https://graph.facebook.com/' . $user_profile['id'] . '/picture?width=480&height=480';
					$data = array(
					'identifier' => $identifier,
					'name'       => $name,
					'EMAIL'      => $email,
					'FNAME'      => $fname,
					'LNAME'      => $lname,						
					'link'       => $link,					
					'type'       => 'facebook',	
					'avatar'     => $avatar,
					);
					
					self::wow_login($data);
				}
				else {
					$return_user_details->status = 'ERROR';
					$return_user_details->error_code = 2;
					$return_user_details->error_message = 'INVALID AUTHORIZATION';
				}
			}
			self:: redirect( $encoded_url );
		}
		else {
			
			// Well looks like we are a fresh dude, login to Facebook!
			$helper = $fb->getRedirectLoginHelper();
			$permissions = array(
			'email',
			'public_profile'
			);
			// optional
			$loginUrl = $helper->getLoginUrl( $callback, $permissions );
			self:: redirect( $loginUrl );
		}
	
	}
	
