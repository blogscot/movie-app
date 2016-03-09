<?php

$app->get('/viewpurchases', function() use ($app) {
  $purchases = $app->auth->transactions_adverts();
  $app->render('advert/purchases.twig', [
    'purchases' => $purchases
  ]);
})->name('advert.purchases');