<?php

$app->get('/', function() use ($app){
  $adverts = $app->advert->get_all();

  $app->render('home.twig', [
    'adverts' => $adverts
  ]);
})->name('home');