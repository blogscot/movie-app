<?php

return [

  'app' => [
    'url' => 'http://localhost',
    'uploads' => 'http://localhost:8888/uploads/',
    'hash' => [
      'algo' => PASSWORD_BCRYPT,
      'cost' => 12
    ]
  ],

  'db' => [
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'name' => 'advert_db',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => ''
  ],

  'auth' => [
    'session' => 'id',
    'remember' => 'user_r'
  ],

  'mail' => [
    'smtp_auth' => true,
    'smtp_secure' => 'tls',
    'host' => 'smtp.gmail.com',
    'username' => 'teamjisc@gmail.com',
    'password' => 'abertayteamworking',
    'port' => 587,
    'html' => true
  ],

  'twig' => [
    'debug' => true
  ],

  'csrf' => [
    'key' => 'csrf_token'
  ]

];