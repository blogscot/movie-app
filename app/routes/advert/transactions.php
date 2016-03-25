<?php

$app->get('/transactions', $authenticated(), function() use ($app) {
  $transactions = $app->auth->transactions_adverts();
  $app->render('advert/transactions.twig', [
    'transactions' => $transactions
  ]);
})->name('advert.transactions');