<?php
    namespace SocialOauth;

    class SocialOauth {
        public $social_oauth_version = '1.0';
        protected $client_id;
        protected $client_secret;
        protected $scope;
        protected $redirect_uri;
        protected $state;
        protected $nonce;
        protected $code;
        protected $access_token;
        protected $request_url;

        private $oauth_version;
        private $dialog_url;
        private $access_token_url;
        private $response_type;
        private $user_profile_url;
        private $header;

        public function __construct() {
            $this->accessToken = null;
            $this->nonce = time() . rand();
        }

        public function getClientId() {
            return $this->client_id;
        }

        public function setClientId($client_id) {
            return $this->client_id = $client_id;
        }

        public function getClientSecret() {
            return $this->client_secret;
        }

        public function setClientSecret($client_secret) {
            return $this->client_secret = $client_secret;
        }

        public function getScope() {
            return $this->scope;
        }

        public function setScope($scope) {
            return $this->scope = $scope;
        }

        public function getRedirectUri() {
            return $this->redirect_uri;
        }

        public function setRedirectUri($redirect_uri) {
            return $this->redirect_uri = $redirect_uri;
        }

        public function getState() {
            return $this->state;
        }

        public function setState($state) {
            return $this->state = $state;
        }

        public function getCode() {
            return $this->code;
        }

        public function setCode($code) {
            return $this->code = $code;
        }

        public function Authorize() {
    
            if($this->oauth_version == "2.0"){
                $dialog_url = $this->dialogUrl 
                    ."client_id=" . $this->client_id 
                    ."&response_type=" . $this->responseType 
                    ."&scope=" . $this->scope
                    ."&state=" . $this->state
                    ."&redirect_uri=" . urlencode($this->redirect_uri);
            } else {
                $date = new DateTime();
                $request_url = $this->requestUrl;
                $postvals ="oauth_consumer_key=".$this->client_id
                    ."&oauth_signature_method=HMAC-SHA1"
                    ."&oauth_timestamp=".$date->getTimestamp()
                    ."&oauth_nonce=".$this->nonce
                    ."&oauth_callback=".$this->redirect_uri
                    ."&oauth_signature=".$this->client_secret
                    ."&oauth_version=1.0";

                $redirect_url = $request_url . "" . $postvals;
                
                $oauth_redirect_value = $this->curl_request($redirect_url, 'GET', '');

                $dialog_url = $this->dialogUrl . $oauth_redirect_value;             
            }
            // @todo: find a better way to redirect
            echo("<script> top.location.href='" . $dialog_url . "'</script>");

        }

        public function requestAccessToken(){
            $postvals = "client_id=" . $this->client_id
                ."&client_secret=" . $this->client_secret
                ."&grant_type=authorization_code"
                ."&redirect_uri=" . urlencode($this->redirect_uri)
                ."&code=" . $this->code;

            $access_token_value = $this->curl_request($this->accessTokenUrl, 'POST', $postvals);
            $decode_access_token = json_decode( stripslashes($access_token_value) );

            if( $decode_access_token !== NULL ){
                $access_token_value = $decode_access_token->access_token;
            }   

            return $access_token_value;
        }

        public function getUserProfile() {
            $access_token_value = $this->requestAccessToken();

            if ($this->userProfileUrl){
                $profile_url = $this->userProfileUrl."".$atoken;
                return $this->curl_request($profile_url,"GET",$access_token_value);
            } else {
                return null;
            }
        }

        public function curl_request($url, $method, $postvals) {
            $ch = curl_init($url);
            if ($method == "POST") {
                $options = array(
                    CURLOPT_POST => 1,
                    CURLOPT_POSTFIELDS => $postvals,
                    CURLOPT_RETURNTRANSFER => 1,
                );
            } else {
                $options = array(
                    CURLOPT_RETURNTRANSFER => 1,
                );
            }
            curl_setopt_array($ch, $options);
            if($this->header) {
                curl_setopt($ch, CURLOPT_HTTPHEADER, array( $this->header . $postvals));
            }

            $response = curl_exec($ch);
            curl_close($ch);

            return $response;
        }
    }