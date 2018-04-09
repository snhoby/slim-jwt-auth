<?php
/**
 * Middleware to verify Authtoken
 */
namespace AppMiddleware;

Class AuthMiddleware
{    
    private $container;

    public function __construct($container) {
        $this->container = $container;
    }
    public function __invoke($request, $response, $next) {
        $authHeader = $request->getHeader('Authorization');   
        try {
            $token = $this->container['util']->varifyAuthToken($authHeader);     
            return $next($request->withAttribute('token', $token), $response);
        }
        catch(\AppException\BadRequest $e) {
            return $response->withStatus(400);
        }       
        catch(\Exception $e) {
            return $response->withStatus(401);
        }             
    }
}
