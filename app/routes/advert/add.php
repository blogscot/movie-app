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

    // calculate daily ad rate
    $ad_rate = $app->advert->calc_daily_rate($description);

    $wallet = $app->auth->wallet;
    $ad_cost = round($ad_rate * $duration, 2);

    // check the user has enough money
    if ($ad_cost < $wallet->balance) {

      // Upload image file
      if (uploadImageFile($app) == false) {
        // Display upload flash error message
        $app->render('advert/add.twig', [
           'errors' => $v->errors(),
           'request' => $request
        ]);
        return;
      }

      // Deduct the cost of the adverts
      $wallet->balance -= $ad_cost;
      $wallet->save();

      // store user uploads in their own directory
      $file_url = $app->config->get('app.uploads') . $app->auth->username . "/" . $fileToUpload;

      // Save the new advert
      $advert = new Advert;
      $advert->title = $title;
      $advert->price = $price;
      $advert->image_url = $file_url;
      $advert->category = $category;
      $advert->description = $description;
      $advert->expires_on = date('Y/m/d H:i:s', strtotime('+' . $duration . ' days'));
      $advert->seller_id = $app->auth->id;
      $advert->save();

      // Record the transaction
      $transaction = $app->transaction;
      $transaction->title = $advert->title;
      $transaction->reason = "New Ad";
      $transaction->buyer_id = $app->auth->id; // action by user
      $transaction->amount = $ad_cost;
      $transaction->balance = $wallet->balance;
      $transaction->save();

    } else {
      $app->flashNow('global', 'Please add funds to complete this purchase.');
      $app->render('advert/add.twig', [
         'errors' => $v->errors(),
         'request' => $request
      ]);
      return;
    }

    $app->flash('global', 'New Advert added!');
    return $app->response->redirect($app->urlFor('user.profile'));
  }

  $app->render('advert/add.twig', [
     'errors' => $v->errors(),
     'request' => $request
  ]);

})->name('advert.add.post');

function uploadImageFile($app) {
  // each user gets their own subfolder
  $upload_dir = "uploads/";
  $target_dir = $upload_dir . $app->auth->username . "/";
  $maximum_file_upload_size = 100000;

  if (!is_dir($target_dir)) {
    // Is this the very first run?
    if (!is_dir($upload_dir)) {
      mkdir($upload_dir);
    }
    // create dir for new user
    mkdir($target_dir);
  }

  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

  // Check if image file is a actual image or fake image
  $tmp_filename = $_FILES["fileToUpload"]["tmp_name"];

  // is the file a image?
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check == false) {
    $app->flashNow('global', 'File is not an image.');
    return false;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > $maximum_file_upload_size) {
      $app->flashNow('global', 'Sorry, your file is too large.');
      return false;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    $app->flashNow('global', 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
    return false;
  }

  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $app->flashNow('global', 'The file '. basename( $_FILES["fileToUpload"]["name"]). ' has been uploaded.');
    return true;
  } else {
    $app->flashNow('global', 'Sorry, there was an error uploading your file.');
    return false;
  }
}
