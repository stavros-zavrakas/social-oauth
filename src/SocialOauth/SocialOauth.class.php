<?php
    namespace SocialOauth;

    use InvalidArgumentException;

    class SocialOauth {
        protected $client_id;
        protected $client_secret;
        protected $scope;
        protected $redirect_uri;
        protected $state;
        protected $nonce;
        protected $code;
        protected $access_token;
        protected $request_url;

        protected $oauth_version;
        protected $dialog_url;
        protected $access_token_url;
        protected $response_type;
        protected $user_profile_url;
        protected $header;

        public function __construct() {
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

        public function getAccessToken() {
            return $this->access_token;
        }

        public function setAccessToken($access_token) {
            return $this->access_token = $access_token;
        }

        public function authorize() {
            if($this->oauth_version == "2.0") {
                $query_data = array(
                    'client_id' => $this->client_id,
                    'response_type' => $this->response_type,
                    'scope' => $this->scope,
                    'state' => $this->state,
                    'redirect_uri' => $this->redirect_uri
                );

                $dialog_url = $this->dialog_url . http_build_query($query_data);
            } else {
                $timestamp = time();
                $request_url = $this->request_url;
                
                $query_data = array(
                    'oauth_consumer_key' => $this->client_id,
                    'oauth_signature_method' => "HMAC-SHA1",
                    'oauth_timestamp' => $timestamp,
                    'oauth_nonce' => $this->nonce,
                    'oauth_callback' => $this->redirect_uri,
                    'oauth_signature' => $this->client_secret,
                    'oauth_version' => "1.0"
                );

                $redirect_url = $request_url . http_build_query($query_data);
                
                $oauth_redirect_value = $this->curl_request($redirect_url, 'GET', null);

                $dialog_url = $this->dialog_url . $oauth_redirect_value;             
            }
            header("Location: $dialog_url");
            exit;
        }

        public function requestAccessToken() {
            $query_data = array(
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
                'grant_type' => "authorization_code",
                'redirect_uri' => $this->redirect_uri,
                'code' => $this->code
            );
            $post_values = http_build_query($query_data);
            
            $access_token_value = $this->curl_request($this->access_token_url, 'POST', $post_values);
            $decode_access_token = json_decode( stripslashes($access_token_value) );

            if($decode_access_token !== null) {
                $access_token_value = $decode_access_token->access_token;
            } 

            return $access_token_value;
        }

        public function getUserProfile() {
            if ($this->user_profile_url && $this->access_token) {
                $profile_url = "$this->user_profile_url" . $this->access_token;
                return $this->curl_request($profile_url, "GET", $this->access_token);
            } else {
                return null;
            }
        }

        public function curl_request($url, $method, $data_to_send = null) {
            $ch = curl_init($url);
            
            $options = array();
            $options[CURLOPT_RETURNTRANSFER] = 1;

            if ($method == "POST") {
                $options[CURLOPT_POST] = 1;
                $options[CURLOPT_POSTFIELDS] = $data_to_send;
            }
            
            curl_setopt_array($ch, $options);
            if($this->header && $data_to_send) {
                curl_setopt($ch, CURLOPT_HTTPHEADER, array( $this->header . $data_to_send));
            }

            $response = curl_exec($ch);
            curl_close($ch);

            return $response;
        }
    }