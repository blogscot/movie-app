<?php

$app->get('/viewadvert/:id', function($id) use ($app) {
  $advert = $app->advert->where('id', $id)->first();
  $app->render('advert/view.twig',[
    'advert' => $advert
  ]);
})->name('advert.view');

$app->post('/viewadvert/:id', function($id) use ($app) {
  echo 'Posted';
})->name('advert.view.post');