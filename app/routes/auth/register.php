<?php

use MovieApp\User\User_Permission;

$app->get('/register', $guest(), function() use ($app){
   $app->render('auth/register.twig');
})->name('auth.register');

$app->post('/register', $guest(), function() use ($app){

   $request = $app->request;

   $firstname = $request->post('firstname');
   $surname = $request->post('surname');
   $username = $request->post('username');
   $email = $request->post('email');
   $password1 = $request->post('password1');
   $password2 = $request->post('password2');

   $v = $app->validation;

   $v->validate([
      'firstname' => [$firstname, 'required|alpha|max(35)'],
      'surname' => [$surname, 'required|alpha|max(35)'],
      'username' => [$username, 'required|alnum|max(20)|uniqueUsername'],
      'email' => [$email, 'required|email|max(50)|uniqueEmail'],
      'password1' => [$password1, 'required|min(8)|max(35)|matches(password2)'],
      'password2' => [$password2, 'required']
   ]);

   if($v->passes()){
      $identifier = $app->randomLib->generateString(128);

      $user = $app->user->create([
         'username' => $username,
         'firstname' => $firstname,
         'surname' => $surname,
         'email' => $email,
         'password' => $app->hash->password($password1)
      ]);

      $user->permissions()->create(User_Permission::$defaults);

      $app->flash('global', 'You have been registered.');
      return $app->response->redirect($app->urlFor('auth.login'));
   }

   $app->render('auth/register.twig', [
      'errors' => $v->errors(),
      'request' => $request
   ]);

})->name('auth.register.post');