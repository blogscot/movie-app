<?php

$app->get('/viewbyuser', $authenticated(), function() use ($app) {

  $adverts = $app->advert
    ->where('seller_id', $app->auth->id)
    ->get();

  $app->render('advert/viewbyuser.twig', [
    'adverts' => $adverts
  ]);

})->name('advert.viewbyuser');