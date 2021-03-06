<?php
    require(__DIR__ . "/../src/SocialGoogleOauth.class.php");

    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

    $oauth_consumer = new \SocialOauth\SocialGoogleOauth();
    $oauth_consumer->setClientId("google_client_id");
    $oauth_consumer->setClientSecret("google_client_secret");
    $oauth_consumer->setScope("https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile");
    $oauth_consumer->setRedirectUri($protocol . $_SERVER['HTTP_HOST'] . '/google.example.php');
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