<?php

$app->get('/viewadvert/:id', $authenticated(), function($id) use ($app) {
  $advert = $app->advert->find_by_id($id);

  $app->render('advert/view.twig',[
    'advert' => $advert
  ]);
})->name('advert.view');

$app->post('/viewadvert/:id', $authenticated(), function($id) use ($app) {
  $advert = $app->advert->find_by_id($id);
  $buyer_id = $app->auth->id;
  $seller_id = $advert->seller_id;
  $wallet_buyer = $app->auth->wallet;
  $wallet_seller = $app->wallet->get_wallet($seller_id);
  $transaction = $app->transaction;

  // the user wants to buy the selected movie
  // check the user has enough money
  if ($advert->price < $wallet_buyer->balance) {

    // exchange monies
    $wallet_buyer->balance -= $advert->price;
    $wallet_seller->balance += $advert->price;
    $wallet_buyer->save();
    $wallet_seller->save();

    // mark the movie as sold
    $advert->isSold = true;
    $advert->save();

    // record the sale transaction for the buyer
    $transaction->reason = "Purchase";
    $transaction->buyer_id = $buyer_id;
    $transaction->advert_id = $advert->id;
    $transaction->note = $advert->title;
    $transaction->amount = $advert->price;
    $transaction->balance = $wallet_buyer->balance;
    $transaction->save();

    //TODO record the transaction for the seller

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