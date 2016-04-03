<?php

$app->get('/transactions', $authenticated(), function() use ($app) {
  $transactions = $app->auth->all_transactions();
  $app->render('advert/transactions.twig', [
    'transactions' => $transactions
  ]);
})->name('advert.transactions');