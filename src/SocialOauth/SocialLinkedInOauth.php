<?php
    namespace SocialOauth;

    require_once "SocialOauth.php";

    class SocialLinkedInOauth extends SocialOauth {

        public function __construct() {
            $this->oauth_version = "2.0";         
            $this->dialog_url = "https://www.linkedin.com/uas/oauth2/authorization?";
            $this->access_token_url = "https://www.linkedin.com/uas/oauth2/accessToken?";
            $this->response_type = "code";
            $this->user_profile_url = "https://api.linkedin.com/v1/people/~:(id,first-name,last-name,emailAddress)?format=json&oauth2_access_token=";
            $this->header = "";
        }
    }