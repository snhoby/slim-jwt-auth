<?php

namespace AppHelper;

class Util {  

    protected $settings; 
    protected $logger;

    // constructor receives container instance
    public function __construct($settings, $logger) {
        $this->settings = $settings;
        $this->logger = $logger;
    }
    
    public function createAuthToken($data) {
        $tokenId = base64_encode(random_bytes(32)); // Unique Id for the token
        $issuedAt   = time();   // Time of issues
        $notBefore  = $issuedAt;    // Can Add 10 seconds for not before to avaoid immidiate use of the token  
        $expire     = $notBefore + $this->settings['tokenValidity'];   // Expiry Adding 60 seconds

        $data = [
            'iat' => $issuedAt,    // Issued at: time when the token was generated
            'jti' => $tokenId,     // Json Token Id: an unique identifier for the token            
            'nbf' => $notBefore,   // Not before
            'exp' => $expire,      // Expire
            'iss' => $this->settings['server'],
            'data'=> $data         //Payload    
        ];
        
        $jwt =  \Firebase\JWT\JWT::encode($data, $this->settings['jwtKey'], 'HS512');

        return array(
            'token' => $jwt,
            'expires' => $expire
        );   

    }

    public function varifyAuthToken($authHeader) {
        if (!$authHeader){
             throw new \AppException\BadRequest();
        }
        //Extract the jwt from the Bearer            
        list($jwt) = sscanf($authHeader[0], 'Bearer %s');
        if(!$jwt){
            throw new \AppException\BadRequest();        
        }
        $token = (array) \Firebase\JWT\JWT::decode($jwt, $this->settings['jwtKey'], array('HS512'));        
        return $token;
    }
}