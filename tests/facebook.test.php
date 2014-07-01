<?php
	require(__DIR__ . "/../src/SocialFacebookOauth.class.php");

    $oauth_consumer = new \SocialOauth\SocialFacebookOauth();
    $oauth_consumer->setClientId("FacebookId");
    $oauth_consumer->setClientSecret("FacebookSecret");
    $oauth_consumer->setScope("email, user_birthday, user_about_me, user_likes");
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