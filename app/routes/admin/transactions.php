<?php

$app->get('/transactions/:id', $admin(), function($id) use ($app) {
  $user = $app->auth->getUserById($id);
  $transactions = $user->transactions_adverts();

  $app->render('admin/transactions.twig', [
    'transactions' => $transactions
  ]);
})->name('admin.transactions');