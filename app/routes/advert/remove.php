<?php

$app->get('/remove/:id', $authenticated(), function($id) use ($app) {

  $advert = $app->advert->where('id', $id)->first();

  if ($advert) {
    $advert->delete();
  }

  $adverts = $app->advert->get();
  $app->render('advert/viewall.twig', [
    'adverts' => $adverts
    ]);
})->name('advert.remove');