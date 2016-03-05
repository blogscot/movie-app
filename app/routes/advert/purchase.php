<?php

$app->get('/viewpurchases', function() use ($app) {
  $purchases = $app->transaction->find_by_user($app->auth->id);
  $app->render('advert/purchases.twig', [
    'purchases' => $purchases
  ]);
})->name('advert.purchases');