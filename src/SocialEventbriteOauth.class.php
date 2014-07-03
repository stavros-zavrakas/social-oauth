<?php
    namespace SocialOauth;

    require_once "SocialOauth.class.php";

    class SocialEventbriteOauth extends SocialOauth {

        public function __construct() {
            $this->oauth_version = "2.0";         
            $this->dialog_url = "https://www.eventbrite.com/oauth/authorize?";
            $this->access_token_url = "https://www.eventbrite.com/oauth/token";
            $this->response_type = "code";
            $this->user_profile_url = "https://www.eventbriteapi.com/v3/users/me/?token=";
            $this->header = "";
        }
    }