<?php
	require(__DIR__ . "/../src/SocialLinkedInOauth.class.php");

    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

    $oauth_consumer = new \SocialOauth\SocialLinkedInOauth();
    $oauth_consumer->setClientId("linked_in_id");
    $oauth_consumer->setClientSecret("linked_in_secret");
    $oauth_consumer->setScope("r_fullprofile r_emailaddress");
    $oauth_consumer->setRedirectUri($protocol . $_SERVER['HTTP_HOST'] . '/linkedIn.example.php');
    $oauth_consumer->setState("state");

    if(empty($_REQUEST["code"])) {
        $oauth_consumer->authorize();
    } else {
        $callback_data = Input::get('state');
        $oauth_consumer->setCode($_REQUEST["code"]);
        $access_token = $oauth_consumer->requestAccessToken();
        $oauth_consumer->setAccessToken($access_token);
        $user = $oauth_consumer->getUserProfile();
        $user = json_decode($user);

        echo print_r($user);
    }