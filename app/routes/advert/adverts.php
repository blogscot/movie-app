<?php

$app->get('/adverts', $authenticated(), function() use ($app) {

  $adverts = $app->auth->adverts;

  $app->render('advert/adverts.twig', [
    'adverts' => $adverts
  ]);

})->name('advert.adverts');
