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
  $fileToUpload = $_FILES["fileToUpload"]["name"];
  $category = $request->post('category');
  $description = $request->post('description');

  $v->validate([
    'title' => [$title, 'required|min(3)|max(40)'],
    'price' => [$price, 'required|number|min(0)'],
    'fileToUpload' => [$fileToUpload, 'required|max(128)'],
    'category' => [$category, 'required|max(20)'],
    'description' => [$description, 'max(512)']
  ]);

  if ($v->passes()) {
    //upload image file
    if (uploadImageFile($app) != false) {
      // calculate daily ad rate
      $ad_rate = $app->advert->calculate_ad_rate($description);

      // store user uploads in their own directory
      $file_url = $app->config->get('app.uploads') . $app->auth->username . "/" . $fileToUpload;

      $advert = new Advert;
      $advert->title = $title;
      $advert->price = $price;
      $advert->image_url = $file_url;
      $advert->category = $category;
      $advert->description = $description;
      $advert->ad_rate = $ad_rate;
      $advert->seller_id = $app->auth->id;
      $advert->save();

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
