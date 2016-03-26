<?php

$app->get('/viewadverts/:id', $admin(), function($id) use ($app) {
  $user = $app->auth->getUserById($id);
  $adverts = $user->adverts;

  $app->render('admin/adverts.twig', [
    'adverts' => $adverts
  ]);

})->name('admin.adverts');