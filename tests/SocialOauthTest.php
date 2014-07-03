<?php

    class SocialOauthTest extends PHPUnit_Framework_TestCase {
        
        private $social_oauth_consumer = null;
        
        public function setUp() {
            $this->social_oauth_consumer = new SocialOauth\SocialOauth;
        }

        public function tearDown() {
            $this->social_oauth_consumer = null;
        }

        public function testInstanceOf() {
            $this->assertInstanceOf('SocialOauth\SocialOauth', $this->social_oauth_consumer);
        }
    }