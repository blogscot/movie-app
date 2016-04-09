<?php

$app->get('/remove/:id/:sellerId/:backPage', $authenticated(),
  function($id, $sellerId, $backPage="") use ($app) {

  $advert = $app->advert->where('id', $id)->first();

  if ($advert) {
    $advert->delete();
  }

  // get the remaining adverts for current seller
  $adverts = $app->advert->find_seller_adverts_by_id($sellerId);

  if ($backPage == "adminPage") {
    $app->render('admin/adverts.twig', [
      'adverts' => $adverts,
      'username' => $app->user->getUsernameById($sellerId),
      'userId' => $sellerId
    ]);
  } else {
    $app->render('advert/adverts.twig', [
      'adverts' => $adverts
    ]);
  }
})->name('advert.remove');