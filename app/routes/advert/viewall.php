<?php

$app->get('/viewadverts', function() use ($app) {

  $adverts = $app->advert->get();

  $app->render('advert/viewall.php', [
    'adverts' => $adverts
  ]);
  
})->name('advert.viewall');