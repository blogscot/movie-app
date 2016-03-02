<?php

use MovieApp\Advert\Advert;

$app->get('/addadvert', function() use ($app) {
  $app->render('advert/add.twig');
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
    $ad_rate = $app->advert->calculate_ad_rate($description);

    $advert = new Advert;
    $advert->title = $title;
    $advert->price = $price;
    $advert->category = $category;
    $advert->description = $description;
    $advert->ad_rate = $ad_rate;
    $advert->seller_id = $app->auth->id;
    $advert->save();

    $app->flash('global', 'New Advert added!');
    $app->response->redirect($app->urlFor('advert.viewall'));
  }

  $app->render('advert/add.twig', [
     'errors' => $v->errors(),
     'request' => $request
  ]);

})->name('advert.add.post');