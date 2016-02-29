<?php

use Slim\Slim;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

use Noodlehaus\Config;

use RandomLib\Factory as RandomLib;

use MovieApp\User\User;

use MovieApp\Advert\Advert;

use MovieApp\Helpers\Hash;

use MovieApp\Validation\Validator;

use MovieApp\Middleware\CsrfMiddleware;
use MovieApp\Middleware\BeforeMiddleware;

session_cache_limiter(false);
session_start();

ini_set('display_errors', 'On');

define('INC_ROOT', dirname(__DIR__));

require INC_ROOT . '/vendor/autoload.php';

$app = new Slim([
   'mode' => file_get_contents(INC_ROOT . '/mode.php'),
   'view' => new Twig(),
   'templates.path' => INC_ROOT . '/app/views'
]);

$app->add(new BeforeMiddleware);
$app->add(new CsrfMiddleware);

$app->configureMode($app->config('mode'), function() use ($app){
   $app->config = Config::load(INC_ROOT . "/app/config/{$app->mode}.php");
});

require 'database.php';
require 'filters.php';
require 'routes.php';

$app->auth = false;

$app->container->set('user', function(){
   return new User;
});

$app->container->set('advert', function(){
   return new Advert;
});

$app->container->set('hash', function() use ($app){
   return new Hash($app->config);
});

$app->container->set('validation', function() use ($app){
   return new Validator($app->user, $app->hash, $app->auth);
});

$app->container->singleton('randomLib', function(){
   $factory = new RandomLib;
   return $factory->getMediumStrengthGenerator();
});

$view = $app->view();

$view->parserOptions = [
   'debug' => $app->config->get('twig.debug')
];

$view->parserExtensions = [
   new TwigExtension
];