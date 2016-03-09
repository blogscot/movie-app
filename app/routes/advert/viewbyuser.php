<?php

$app->get('/viewbyuser', $authenticated(), function() use ($app) {

  $adverts = $app->auth->adverts;

  $app->render('advert/viewbyuser.twig', [
    'adverts' => $adverts
  ]);

})->name('advert.viewbyuser');