<?php
return array(
    'server' => 'localhost',
    'displayErrorDetails' => false,
    'addContentLengthHeader' => false,
    'jwtKey' => '12345',
    'tokenValidity' => 1800, //In seconds
    'logger' => [
        'name' => 'app-logger',
        'level' => Monolog\Logger::DEBUG,
        'path' => __DIR__ . '/../logs/app.log',
    ],
    'db' => array(
        'host' => '',
        'user' => '',
        'pass' => '',
        'dbname' => ''
    )
);