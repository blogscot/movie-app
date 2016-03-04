<?php

$app->get('/viewadvert/:id', function($id) use ($app) {
  $advert = $app->advert->find_by_id($id);
  
  $app->render('advert/view.twig',[
    'advert' => $advert
  ]);
})->name('advert.view');

$app->post('/viewadvert/:id', function($id) use ($app) {
  echo 'Posted';
})->name('advert.view.post');