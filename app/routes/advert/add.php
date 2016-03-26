<?php

use MovieApp\Advert\Advert;

$app->get('/addadvert', $authenticated(), function() use ($app) {
  $app->render('advert/add.twig');
})->name('advert.add');

$app->post('/addadvert', $authenticated(), function() use ($app) {

  $request = $app->request;
  $v = $app->validation;

  $title = $request->post('title');
  $price = $request->post('price');
  $duration = floatval($request->post('duration'));
  $fileToUpload = $_FILES["fileToUpload"]["name"];
  $category = $request->post('category');
  $description = $request->post('description');

  $v->validate([
    'title' => [$title, 'required|min(3)|max(40)'],
    'price' => [$price, 'required|number|min(0)'],
    'duration' => [$duration, 'required|int|between(7,28)'],
    'fileToUpload' => [$fileToUpload, 'required|max(128)'],
    'category' => [$category, 'required|max(20)'],
    'description' => [$description, 'max(512)']
  ]);

  if ($v->passes()) {
    //upload image file
    if (uploadImageFile($app) != false) {

      switch ($duration) {
        case 7:
          $weeks = "+1 Week";
          break;
        case 14:
          $weeks = "+2 Week";
          break;
        case 21:
          $weeks = "+3 Week";
          break;
        case 28:
          $weeks = "+4 Week";
          break;
        default:
          $weeks = "+1 Week";
          break;
      }

      // store user uploads in their own directory
      $file_url = $app->config->get('app.uploads') . $app->auth->username . "/" . $fileToUpload;

      // calculate daily ad rate
      $ad_rate = $app->advert->calc_daily_rate($description);

      $advert = new Advert;
      $advert->title = $title;
      $advert->price = $price;
      $advert->image_url = $file_url;
      $advert->category = $category;
      $advert->description = $description;
      $advert->ad_rate = $ad_rate;
      $advert->expires_on = date('Y/m/d H:i:s', strtotime($weeks));
      $advert->seller_id = $app->auth->id;
      $advert->save();

      // Deduct the cost of the adverts
      // check the user has enough money
      $wallet = $app->auth->wallet;
      $ad_cost = round($ad_rate * $duration, 2);

      if ($ad_cost < $wallet->balance) {
        $wallet->balance -= $ad_cost;
        $wallet->save();

        // record the transaction
        $transaction = $app->transaction;
        $transaction->reason = "New Ad";
        $transaction->buyer_id = $app->auth->id;
        $transaction->amount = $ad_cost;
        $transaction->balance = $wallet->balance;
        $transaction->save();

      } else {
        $app->flash('global', 'Please add funds to complete this purchase.');
        return $app->response->redirect($app->urlFor('advert.add'));
      }

      $app->flash('global', 'New Advert added!');
      $app->response->redirect($app->urlFor('advert.viewall'));
    } else {
      // display upload flash error message
      return $app->response->redirect($app->urlFor('advert.add'));
    }
  }

  $app->render('advert/add.twig', [
     'errors' => $v->errors(),
     'request' => $request
  ]);

})->name('advert.add.post');

function uploadImageFile($app) {

  $uploads = "uploads/";
  $target_dir = "uploads/" . $app->auth->username . "/";

  if (!is_dir($target_dir)) {
    mkdir($target_dir);
  }

  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

  // Check if image file is a actual image or fake image
  $tmp_filename = $_FILES["fileToUpload"]["tmp_name"];

  // is the file a image?
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check == false) {
    $app->flash('global', 'File is not an image.');
    return false;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 100000) {
      $app->flash('global', 'Sorry, your file is too large.');
      return false;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    $app->flash('global', 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
    return false;
  }

  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $app->flash('global', 'The file '. basename( $_FILES["fileToUpload"]["name"]). ' has been uploaded.');
    return true;
  } else {
    $app->flash('global', 'Sorry, there was an error uploading your file.');
    return false;
  }
}
