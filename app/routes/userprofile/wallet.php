<?php

$app->get('/userwallet', $authenticated(), function() use ($app) {
  $wallet = $app->wallet->get_user_balance($app->auth->id);

  $app->render('userprofile/wallet.twig', [
    'wallet' => $wallet
  ]);
})->name('user.wallet');