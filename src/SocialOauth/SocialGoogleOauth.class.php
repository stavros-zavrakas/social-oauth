<?php
    namespace SocialOauth;

    require_once "SocialOauth.class.php";

    class SocialGoogleOauth extends SocialOauth {

        public function __construct() {
            $this->oauth_version = "2.0";         
            $this->dialog_url = "https://accounts.google.com/o/oauth2/auth?";
            $this->access_token_url = "https://accounts.google.com/o/oauth2/token";
            $this->response_type = "code";
            $this->user_profile_url = "https://www.googleapis.com/oauth2/v1/userinfo?access_token=";
            $this->header = "Authorization: Bearer";
        }
    }