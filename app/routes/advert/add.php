<?php

$app->get('/addadvert', function() use ($app) {
  $app->render('advert/add.php');
})->name('advert.add');

$app->post('/addadvert', function() use ($app) {

  $request = $app->request;

  $title = $request->post('title');
  $price = $request->post('price');

  $v = $app->validation;

  $v->validate([
    'title' => [$title, 'required|min(3)|max(20)'],
    'price' => [$price, 'required|number|min(0)']
  ]);

  if ($v->passes()) {
    $app->advert->create([
      'title' => $title,
      'price' => $price,
      'user_id' => $app->auth->id
    ]);

    $app->flash('global', 'New Advert added!');
    $app->response->redirect($app->urlFor('advert.viewall'));
  }

  $app->render('advert/add.php', [
     'errors' => $v->errors(),
     'request' => $request
  ]);

})->name('advert.add.post');