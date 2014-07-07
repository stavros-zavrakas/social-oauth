<?php
    namespace SocialOauth;

    require_once "SocialOauth.php";

    class SocialFacebookOauth extends SocialOauth {

        public function __construct() {
            $this->oauth_version = "2.0";         
            $this->dialog_url = "https://www.facebook.com/dialog/oauth?";
            $this->access_token_url = "https://graph.facebook.com/oauth/access_token";
            $this->response_type = "code";
            $this->user_profile_url = "https://graph.facebook.com/me/?";
            $this->header = "";
        }
    }