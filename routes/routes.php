<?php
$app->group('/api/v1', function () {  

    //Pubic routes
    require_once 'v1/public.php';

    //Private Routes
    $this->group('', function () { 
        require_once 'v1/protected.php';
    })->add(new \AppMiddleware\AuthMiddleware($this->getContainer()));
    
});