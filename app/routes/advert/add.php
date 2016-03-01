<?php

use MovieApp\Advert\Advert;

$app->get('/addadvert', function() use ($app) {
  $app->render('advert/add.php');
})->name('advert.add');

$app->post('/addadvert', function() use ($app) {

  $request = $app->request;

  $title = $request->post('title');
  $price = $request->post('price');
  $category = $request->post('category');
  $description = $request->post('description');

  $v = $app->validation;

  $v->validate([
    'title' => [$title, 'required|min(3)|max(40)'],
    'price' => [$price, 'required|number|min(0)'],
    'category' => [$category, 'required|max(20)'],
    'description' => [$description, 'max(512)']
  ]);

  if ($v->passes()) {

    // calculate daily ad rate
    $ad_rate = str_word_count($description) / 12 + 10;

    $advert = new Advert;
    $advert->title = $title;
    $advert->price = $price;
    $advert->category = $category;
    $advert->description = $description;
    $advert->ad_rate = $ad_rate;
    $advert->user_id = $app->auth->id;
    $advert->save();

    $app->flash('global', 'New Advert added!');
    $app->response->redirect($app->urlFor('advert.viewall'));
  }

  $app->render('advert/add.php', [
     'errors' => $v->errors(),
     'request' => $request
  ]);

})->name('advert.add.post');