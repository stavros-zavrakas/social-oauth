<?php
	require("../src/SocialGoogleOauth.class.php");

    $oauth_consumer = new \SocialOauth\SocialGoogleOauth();
    $oauth_consumer->setClientId("GoogleId");
    $oauth_consumer->setClientSecret("GoogleSecret");
    $oauth_consumer->setScope("https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile");
    $oauth_consumer->setRedirectUri("http://www.example.com");
    $oauth_consumer->setState("state");
    $oauth_consumer->setCode("code");

    $client_id = $oauth_consumer->getClientId();
    $client_secret = $oauth_consumer->getClientSecret();
    $client_scope = $oauth_consumer->getScope();
    $client_redirect_uri = $oauth_consumer->getRedirectUri();
    $client_state = $oauth_consumer->getState();
    $client_code = $oauth_consumer->getCode();

    echo "$client_id ; $client_secret ; $client_scope ; $client_redirect_uri ; $client_state ; $client_code\n";