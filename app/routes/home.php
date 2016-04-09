<?php

$app->get('/', function() use ($app){
  $adverts = $app->advert->get_items(4);

  $app->render('home.twig', [
    'adverts' => $adverts
  ]);
})->name('home');