<?php

$app->get('/byebye/:userId', $authenticated(), function($userId) use ($app) {
  unset($_SESSION[$app->config->get('auth.session')]);

  $user = $app->auth->getUserById($userId);
  $user->deleteAccount();
  deleteUserImageFiles($user->username);

  $app->flash('global', 'Your account has been successfully deleted.');
  return $app->response->redirect($app->urlFor('auth.login'));
})->name('auth.delete');

function deleteUserImageFiles($username) {
  // each user has their own subfolder
  $target_dir = "uploads/" . $username . "/";

  $files = glob("$target_dir/*.*");
  foreach ($files as $file) {
    unlink($file);
  }
  if (is_dir($target_dir)) {
    rmdir($target_dir);
  }
}