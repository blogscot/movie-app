<?php

$app->get('/byebye', $authenticated(), function() use ($app) {
  unset($_SESSION[$app->config->get('auth.session')]);

  $app->auth->deleteAccount();
  // TODO delete all user's saved image files, and folder

  $app->flash('global', 'Your account has been successfully deleted.');
  return $app->response->redirect($app->urlFor('auth.login'));
})->name('auth.delete');