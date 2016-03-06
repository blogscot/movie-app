<?php

$app->get('/changepassword', $authenticated(), function() use ($app){
   $app->render('auth/password.twig');
})->name('auth.password');

$app->post('/changepassword', $authenticated(), function() use ($app){

   $request = $app->request;

   $password_old = $request->post('password_old');
   $password_new = $request->post('password_new');
   $password_confirm = $request->post('password_confirm');

   $v = $app->validation;

   $v->validate([
      'password_old' => [$password_old, 'required|max(35)'],
      'password_new' => [$password_new, 'required|min(8)|max(35)'],
      'password_confirm' => [$password_confirm, 'required|matches(password_new)'],
   ]);

   if($v->passes()) {
      $user = $app->auth;

      if($app->hash->passwordCheck($password_old, $user->password)) {
         $user->password = $app->hash->password($password_new);
         $user->save();

         $app->flash('global', 'Your password has been changed.');
         return $app->response->redirect($app->urlFor('auth.password.post'));
      } else {
         $app->flash('global', 'Wrong password entered.');
         return $app->response->redirect($app->urlFor('auth.password.post'));
      }
   }

   $app->render('auth/password.twig', [
      'errors' => $v->errors(),
      'request' => $request
   ]);

})->name('auth.password.post');