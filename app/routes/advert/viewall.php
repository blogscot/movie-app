<?php

$app->get('/viewadverts', function() use ($app) {

  $adverts = $app->advert->get();

  $app->render('advert/viewall.twig', [
    'adverts' => $adverts
  ]);

})->name('advert.viewall');