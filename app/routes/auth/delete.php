<?php

$app->get('/byebye', $authenticated(), function() use ($app) {
  unset($_SESSION[$app->config->get('auth.session')]);

  $app->auth->deleteAccount();
  deleteUserImageFiles($app);

  $app->flash('global', 'Your account has been successfully deleted.');
  return $app->response->redirect($app->urlFor('auth.login'));
})->name('auth.delete');

function deleteUserImageFiles($app) {
  // each user has their own subfolder
  $target_dir = "uploads/" . $app->auth->username . "/";

  $files = glob("$target_dir/*.*");
  foreach ($files as $file) {
    unlink($file);
  }
  if (is_dir($target_dir)) {
    rmdir($target_dir);
  }
}