<?php
    namespace SocialOauth;

    require(__DIR__ . "/SocialOauth.class.php");

    class SocialFacebookOauth extends SocialOauth {

        public function __construct() {
            $this->oauth_version = "2.0";         
            $this->dialog_url = "https://www.facebook.com/dialog/oauth?client_id=$this->client_id&redirect_uri=$this->redirect_uri&scope=$this->scope&state=$this->state";
            $this->access_token_url = "https://graph.facebook.com/oauth/access_token";
            $this->response_type = "code";
            $this->user_profile_url = "https://graph.connect.facebook.com/me/?";
            $this->header = "";
        }

    }