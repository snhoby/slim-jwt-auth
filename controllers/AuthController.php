<?php

namespace AppController;

class AuthController {
    
    protected $container; 
    protected $logger;

    // constructor receives container instance
    public function __construct(\Slim\Container $container) {
        $this->container = $container;
        $this->logger = $container->logger;
    }

    public function login($request, $response, $args) {        
        $params = $request->getParsedBody();       
        if( !isset($params['username']) || !isset($params['password'])) {            
            return $response->withStatus(412);
        }               
        /*
         * Add code related to username and password check using any of your favourite database and library/orm
         * For test, token is created with uid = 1
         */        
        $responseData = $this->container->util->createAuthToken(array('uid' => 1));
        return $response->withJson($responseData)->withStatus(201);  
    }

}
