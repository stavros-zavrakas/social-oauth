<?php
	require(__DIR__ . "/../src/SocialFacebookOauth.class.php");

    $oauth_facebook_consumer = new \SocialOauth\SocialFacebookOauth();
    $oauth_facebook_consumer->setClientId("381739765290380");
    $oauth_facebook_consumer->setClientSecret("91030d9ecf46f08abe7e86f663db4f02");
    $oauth_facebook_consumer->setScope("email, user_birthday, user_about_me, user_likes");
    $oauth_facebook_consumer->setRedirectUri("http://www.example.com");
    $oauth_facebook_consumer->setState("state");
    $oauth_facebook_consumer->setCode("code");

    $client_id = $oauth_facebook_consumer->getClientId();
    $client_secret = $oauth_facebook_consumer->getClientSecret();
    $client_scope = $oauth_facebook_consumer->getScope();
    $client_redirect_uri = $oauth_facebook_consumer->getRedirectUri();
    $client_state = $oauth_facebook_consumer->getState();
    $client_code = $oauth_facebook_consumer->getCode();

    echo "$client_id ; $client_secret ; $client_scope ; $client_redirect_uri ; $client_state ; $client_code\n";