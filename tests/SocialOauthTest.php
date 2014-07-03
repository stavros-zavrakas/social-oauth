<?php

    class SocialOauthTest extends PHPUnit_Framework_TestCase {
        
        private $social_oauth_consumer = null;
        private $social_oauth_consumer_facebook = null;
        
        public function setUp() {
            $this->social_oauth_consumer = new SocialOauth\SocialOauth;
            $this->social_oauth_consumer_facebook = new SocialOauth\SocialFacebookOauth;
        }

        public function tearDown() {
            $this->social_oauth_consumer = null;
        }

        function assertThrowsException($exception_name, $code) {
            $e = null;
            try{
                $code();
            }catch (Exception $e) {
                // No more code, we only want to catch the exception in $e
            }

            if($e && $e instanceof $exception_name) {
                echo "\n Correct exception thrown. \n";
            } else {
                echo "\n No exception. \n";
            }
        }

        public function testInstanceOf() {
            $this->assertInstanceOf('SocialOauth\SocialOauth', $this->social_oauth_consumer);
        }

        public function testInvalidSettersArguments() {
            $testing_class = $this->social_oauth_consumer;
            $this->assertThrowsException('InvalidArgumentException', function () use($testing_class) {
                $testing_class->setClientId();
            });

            $this->assertThrowsException('InvalidArgumentException', function () use($testing_class) {
                $testing_class->setClientSecret();
            });

            $this->assertThrowsException('InvalidArgumentException', function () use($testing_class) {
                $testing_class->setCode();
            });

            $this->assertThrowsException('InvalidArgumentException', function () use($testing_class) {
                $testing_class->setAccessToken();
            });
        }
    }