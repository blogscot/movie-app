<?php

$app->get('/update/:id', function($id) use ($app) {
  $advert = $app->advert->where('id', $id)->first();

  $app->render('advert/update.php', [
    'advert' => $advert
  ]);
})->name('advert.update');