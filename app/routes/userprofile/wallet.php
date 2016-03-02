<?php

$app->get('/userwallet', $authenticated(), function() use ($app) {
  $app->render('userprofile/wallet.twig');
})->name('user.wallet');