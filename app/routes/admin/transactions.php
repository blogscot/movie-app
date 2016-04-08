<?php

$app->get('/transactions/:id', $admin(), function($id) use ($app) {
  $user = $app->auth->getUserById($id);
  $transactions = $user->all_transactions();

  $app->render('admin/transactions.twig', [
    'username' => $user->username,
    'transactions' => $transactions
  ]);
})->name('admin.transactions');
