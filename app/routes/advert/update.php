<?php

$app->get('/update/:id', function($id) use ($app) {
  $advert = $app->advert->where('id', $id)->first();

  $app->render('advert/update.php', [
    'advert' => $advert
  ]);
})->name('advert.update');

$app->post('/update/:id', function($id) use ($app) {

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

      // recalculate daily ad rate
      $ad_rate = str_word_count($description) / 12 + 10;

      $advert = $app->advert->where('id', $id)->first();
      $advert->title = $title;
      $advert->price = $price;
      $advert->category = $category;
      $advert->description = $description;
      $advert->ad_rate = $ad_rate;
      $advert->user_id = $app->auth->id;
      $advert->save();

      $app->flash('global', 'Advert updated!');
      $app->response->redirect($app->urlFor('advert.viewall'));
    }

    $app->render('advert/add.php', [
       'errors' => $v->errors(),
       'request' => $request
    ]);

})->name('advert.update.post');