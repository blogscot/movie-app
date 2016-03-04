<?php

$app->get('/viewbyuser', $authenticated(), function() use ($app) {

  $adverts = $app->advert->find_by_seller($app->auth->id);

  $app->render('advert/viewbyuser.twig', [
    'adverts' => $adverts
  ]);

})->name('advert.viewbyuser');