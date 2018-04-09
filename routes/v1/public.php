<?php
//All routes where authentication not required
$this->post('/login', \AppController\AuthController::class . ':login');