<?php

$app->get('/userprofile', $authenticated(), function() use ($app) {
  $app->render('userprofile/profile.twig');
})->name('user.profile');