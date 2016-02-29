<?php

$app->get('/remove/:id', function($id) use ($app) {

  $advert = $app->advert->where('id', $id)->first();

  if ($advert) {
    $advert->delete();
  }

  $adverts = $app->advert->get();
  $app->render('advert/viewall.php', [
    'adverts' => $adverts
    ]);
})->name('advert.remove');