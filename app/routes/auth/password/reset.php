<?php

$app->get('/password-reset', $guest(), function() use ($app){

  $request = $app->request();

  $email = $request->get('email');
  $identifier = $request->get('identifier');

  if(!$email || !$identifier){
     return $app->response->redirect($app->urlFor('home'));
  }

  $hashedIdentifier = $app->hash->hash($identifier);

  $user = $app->user->where('email', $email)->first();

   if(!$user){ // No user with that email found
      $app->flash('global', 'There was a problem activating your account-no user');
      return $app->response->redirect($app->urlFor('home'));
   }

  if(!$user->recover_hash){ // The user hasn't requested a password reset
     $app->flash('global', 'There was a problem activating your account-no recover hash set');
     return $app->response->redirect($app->urlFor('home'));
  }

  if(!$app->hash->hashCheck($user->recover_hash, $hashedIdentifier)){ // The hash given and in the db dont match
      $app->flash('global', 'There was a problem activating your account-hash mismatch');
      return $app->response->redirect($app->urlFor('home'));
  }

  $app->render('auth/password/reset.php', [
    'email' => $user->email,
    'identifier' => $identifier
  ]);

})->name('auth.password.reset');

$app->post('/password-reset', $guest(), function() use ($app){

   $request = $app->request();

   $password1 = $request->post('password');
   $password2 = $request->post('passwordConfirm');

   $email = $request->get('email');
   $identifier = $request->get('identifier');

   $hashedIdentifier = $app->hash->hash($identifier);

   $user = $app->user->where('email', $email)->first();

   if(!$user){
      $app->flash('global', 'no user found');
      return $app->response->redirect($app->urlFor('home'));
   }

   if(!$user->recover_hash){
      $app->flash('global', 'not recovering their pass currently');
      return $app->response->redirect($app->urlFor('home'));
   }

   if(!$app->hash->hashCheck($user->recover_hash, $hashedIdentifier)){
      $app->flash('global', 'hash missmatch');
      return $app->response->redirect($app->urlFor('home'));
   }

   $v = $app->validation;

   $v->validate([
      'password' => [$password1, 'required|min(8)|max(35)|matches(passwordConfirm)'],
      'passwordConfirm' => [$password2, 'required']
   ]);

   $v->addRuleMessages([
       'required' => '*'
   ]);

   $v->addFieldMessages([
      'password' => [
         'min' => 'Minimum of 8 characters',
         'max' => 'Maximum of 35 characters',
         'matches' => 'The two passwords must match'
      ]
   ]);

   if($v->passes()){
      $user->update([
         'password' => $app->hash->password($password1),
         'recoverHash' => null
      ]);

      $app->flash('global', 'Your password has been reset and you can now sign in');
      return $app->response->redirect($app->urlFor('home'));
   }

   $app->render('auth/password/reset.php', [
      'errors' => $v->errors(),
      'email' => $user->email,
      'identifier' => $identifier
   ]);

})->name('auth.password.reset.post');