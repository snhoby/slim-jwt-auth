# slim-jwt-auth
PHP Authentication with JWT and Slim 3

## Requirement ###

* PHP7
* PHP Composer

## Dependecies ###

* Slim framework
* Monolog
* firebase/php-jwt

## Installation instruction ###

* Clone this repository on your pc.
* Open command-prompt/terminal and change directory to root folder of the repository.
* Run "composer install". This will install all the dependencies.
* Now change directory in command prompt to "public"
* Run command "php -S localhost:8080" to start php local server.
* Test APIs using postman or any other similar tool

## Test API

### Login
http://localhost:8080/api/v1/login

##### Param:
* Name: username 
* Value: test

* Name: password
* Value: test

##### Return: 
API should return JSON data with token and expiry time

----------------

### Auth Test
http://localhost:8080/api/v1/authtest

##### Header
* Name: Authorization
* value: Bearer <TOKEN RECEIVED FROM LOGIN API>

##### Return 
API should return JSON data with status 200