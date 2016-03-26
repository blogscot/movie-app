<?php

$app->get('/update/:id', $authenticated(), function($id) use ($app) {
  $advert = $app->advert->find_by_id($id);

  $app->render('advert/update.twig', [
    'advert' => $advert
  ]);
})->name('advert.update');

$app->post('/update/:id', $authenticated(), function($id) use ($app) {

    $request = $app->request;

    $title = $request->post('title');
    $price = $request->post('price');
    $fileToUpload = $_FILES["fileToUpload"]["name"];
    $category = $request->post('category');
    $description = $request->post('description');

    $v = $app->validation;

    $v->validate([
      'title' => [$title, 'required|min(3)|max(40)'],
      'price' => [$price, 'required|number|min(0)'],
      'fileToUpload' => [$fileToUpload, 'required|max(128)'],
      'category' => [$category, 'required|max(20)'],
      'description' => [$description, 'max(512)']
    ]);

    if ($v->passes()) {

      if (uploadImageFile($app) != false) {
        // recalculate daily ad rate
        $ad_rate = $app->advert->calc_daily_rate($description);

        // store user uploads in their own directory
        $file_url = $app->config->get('app.uploads') . $app->auth->username . "/" . $fileToUpload;

        $advert = $app->advert->where('id', $id)->first();
        $advert->title = $title;
        $advert->price = $price;
        $advert->image_url = $file_url;
        $advert->category = $category;
        $advert->description = $description;
        $advert->ad_rate = $ad_rate;
        $advert->seller_id = $app->auth->id;
        $advert->save();

        $app->flash('global', 'Advert updated!');
        $app->response->redirect($app->urlFor('advert.viewbyuser'));
      } else {
        // display upload flash error message
        return $app->response->redirect($app->urlFor('advert.add'));
      }
    }

    $app->render('advert/add.twig', [
       'errors' => $v->errors(),
       'request' => $request
    ]);

})->name('advert.update.post');