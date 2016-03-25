<?php

$app->get('/userwallet', $authenticated(), function() use ($app) {
  $wallet = $app->wallet->get_wallet($app->auth->id);

  $app->render('userprofile/wallet.twig', [
    'wallet' => $wallet
  ]);
})->name('user.wallet');

$app->post('/walletdeposit', $authenticated(), function() use ($app) {
  $v = $app->validation;
  $wallet = $app->wallet->get_wallet($app->auth->id);

  $funds = $app->request->post('funds');

  $v->validate([
    'funds' => [$funds, 'required|number|min(0)'],
  ]);

  if ($v->passes()) {
    $wallet->balance += $funds;
    $wallet->save();

    // record the transaction
    $transaction = $app->transaction;
    $transaction->reason = "Deposit";
    $transaction->buyer_id = $app->auth->id;
    $transaction->amount = $funds;
    $transaction->balance = $wallet->balance;
    $transaction->save();

    $app->flash('global', 'Desposit successful');
    return $app->response->redirect($app->urlFor('user.wallet'));
  }

  $app->render('userprofile/wallet.twig', [
     'errors' => $v->errors(),
     'wallet' => $wallet
  ]);
})->name('user.deposit.post');

$app->post('/walletwithdraw', $authenticated(), function() use ($app) {
  $v = $app->validation;
  $wallet = $app->wallet->get_wallet($app->auth->id);

  $funds = $app->request->post('funds');

  $v->validate([
    'funds' => [$funds, 'required|number|min(0)'],
  ]);

  if ($v->passes()) {

    if ($funds <= $wallet->balance) {
      $wallet->balance -= $funds;
      $wallet->save();

      // record the transaction
      $transaction = $app->transaction;
      $transaction->reason = "Withdrawal";
      $transaction->buyer_id = $app->auth->id;
      $transaction->amount = $funds;
      $transaction->balance = $wallet->balance;
      $transaction->save();

      $app->flash('global', 'Withdrawal successful.');
      return $app->response->redirect($app->urlFor('user.wallet'));
    } else {
      $app->flash('global', 'Sorry, you do not have sufficient funds.');
      return $app->response->redirect($app->urlFor('user.wallet'));
    }
  }

  $app->render('userprofile/wallet.twig', [
     'errors' => $v->errors(),
     'wallet' => $wallet
  ]);
})->name('user.withdraw.post');