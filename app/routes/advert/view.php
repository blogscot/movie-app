<?php

$app->get('/viewadvert/:id', function($id) use ($app) {
  $advert = $app->advert->find_by_id($id);

  $app->render('advert/view.twig',[
    'advert' => $advert
  ]);
})->name('advert.view');

$app->post('/viewadvert/:id', function($id) use ($app) {
  $advert = $app->advert->find_by_id($id);
  $wallet = $app->wallet->get_user_balance($app->auth->id);

  // the user wants to buy the selected movie
  // check the user has enough money
  if ($advert->price < $wallet->balance) {
    $wallet->balance -= $advert->price;
    $wallet->save();

    // mark the movie as sold
    $advert->isSold = true;
    $advert->save();

    // TODO record the sale transaction

    $app->flash('global', 'Your purchase is complete.');
    return $app->response->redirect($app->urlFor('advert.viewall'));
  } else {
    $app->flash('global', 'Please add funds to complete this purchase.');
    return $app->response->redirect($app->urlFor('advert.view', [
      'id' => $advert->id
    ]));
  }

  $app->render('advert/confirm.twig',[
    'advert' => $advert
  ]);
})->name('advert.view.post');