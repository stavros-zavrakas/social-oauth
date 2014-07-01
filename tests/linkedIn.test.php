<?php
	require(__DIR__ . "/../src/SocialLinkedInOauth.class.php");

    $oauth_consumer = new \SocialOauth\SocialLinkedInOauth();
    $oauth_consumer->setClientId("LinkedInId");
    $oauth_consumer->setClientSecret("LinkedInSecret");
    $oauth_consumer->setScope("r_fullprofile r_emailaddress");
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