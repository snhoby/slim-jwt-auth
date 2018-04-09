<?php 
//All the routes where authentication will be required.
$this->get('/authtest', function ($request, $response, array $args) {    
    $token = $request->getAttribute("token");
    $this->logger->info(json_encode($token));
    $data = array('msg' => 'Authentication Done');     
    return $response->withJson($data);
});