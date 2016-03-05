<?php

$app->get('/userwallet', $authenticated(), function() use ($app) {
  $wallet = $app->wallet->get_user_balance($app->auth->id);

  $app->render('userprofile/wallet.twig', [
    'wallet' => $wallet
  ]);
})->name('user.wallet');

$app->post('/userwallet', $authenticated(), function() use ($app) {
  $request = $app->request;
  $v = $app->validation;

  $funds = $request->post('funds');

  $v->validate([
    'funds' => [$funds, 'required|number|min(0)'],
  ]);

  if ($v->passes()) {
    $wallet = $app->wallet->get_user_balance($app->auth->id);
    $wallet->balance += $funds;
    $wallet->save();

    $app->flash('global', 'New funds added!');
    $app->response->redirect($app->urlFor('user.wallet'));
  }

  $app->render('advert/add.twig', [
     'errors' => $v->errors(),
     'request' => $request
  ]);
})->name('user.wallet.post');