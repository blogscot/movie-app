<?php

use Carbon\Carbon;

$app->get('/login', $guest(), function() use ($app){
   $app->render('auth/login.twig');
})->name('auth.login');

$app->post('/login', $guest(), function() use ($app){

   $request = $app->request;

   $identifier = $request->post('identifier');
   $password = $request->post('password');

   $v = $app->validation;

   $v->validate([
      'identifier' => [$identifier, 'required|alnumDash|max(20)'],
      'password' => [$password, 'required|max(35)']
   ]);

   if($v->passes()) {
      $user = $app->user->where('username', $identifier)->first();

      if($user && $app->hash->passwordCheck($password, $user->password)) {
         $_SESSION[$app->config->get('auth.session')] = $user->id;

         $app->flash('global', 'You are now signed in');
         return $app->response->redirect($app->urlFor('home'));
      } else {
         $app->flash('global', 'Username or password incorrect');
         return $app->response->redirect($app->urlFor('auth.login'));
      }
   }

   $app->render('auth/login.twig', [
      'errors' => $v->errors(),
      'request' => $request
   ]);

})->name('auth.login.post');