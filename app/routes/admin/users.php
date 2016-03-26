<?php

$app->get('/viewusers', $admin(), function() use ($app) {

  $users = $app->auth->get_all_users();

  $app->render('admin/users.twig', [
    'users' => $users
  ]);

})->name('admin.viewusers');