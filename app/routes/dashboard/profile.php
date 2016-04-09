<?php

$app->get('/dashboard', $authenticated(), function() use ($app) {
  $app->render('dashboard/profile.twig');
})->name('user.profile');