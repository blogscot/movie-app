<?php

use MovieApp\Transaction\Transaction;

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
  $seller_username = $app->auth->getUsernameById($seller_id);
  $buyer_username = $app->auth->getUsernameById($buyer_id);
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

    $now = date('Y/m/d H:i:s');

    // Eloquent will overwrite subsequent saves to the same table
    // so this hack is being used to update to records at the same
    // time.

    // Save purchase and sale transactions
    $data = [[
      'title' => $advert->title,
      'reason' => "Seller " . ucfirst($seller_username),
      'buyer_id' => $buyer_id,
      'seller_id' => 0,
      'amount' => $advert->price,
      'balance' => $wallet_buyer->balance,
      'created_at' => $now,
      'updated_at' => $now
    ],
    [
      'title' => $advert->title,
      'reason' => "Buyer " . ucfirst($buyer_username),
      'buyer_id' => 0,
      'seller_id' => $seller_id,
      'amount' => $advert->price,
      'balance' => $wallet_seller->balance,
      'created_at' => $now,
      'updated_at' => $now
    ]
  ];

  Transaction::insert($data);

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