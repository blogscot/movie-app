<?php

use MovieApp\Advert\Advert;

$app->post('/uploadimage', function() use ($app) {

  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = true;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $tmp_filename = $_FILES["fileToUpload"]["tmp_name"];

    if (empty($tmp_filename)) {
      $app->flash('global', 'Sorry, no file specified');
      $uploadOk = false;
      return $app->response->redirect($app->urlFor('advert.add'));
    } else {
      // is the file a image?
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check == false) {
        $app->flash('global', 'File is not an image.');
        return $app->response->redirect($app->urlFor('advert.add'));
      }
    }
  }
  // Check if file already exists
  if (file_exists($target_file)) {
    $app->flash('global', 'Sorry, file already exists.');
    return $app->response->redirect($app->urlFor('advert.add'));
  }
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
      $app->flash('global', 'Sorry, your file is too large.');
      return $app->response->redirect($app->urlFor('advert.add'));
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    $app->flash('global', 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
    return $app->response->redirect($app->urlFor('advert.add'));
  }
  // Check if $uploadOk is set to false by an error
  if ($uploadOk == false) {
    $app->flash('global', 'Sorry, your file was not uploaded.');
    return $app->response->redirect($app->urlFor('advert.add'));
  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

        $app->flash('global', 'The file '. basename( $_FILES["fileToUpload"]["name"]). ' has been uploaded.');
      } else {
        $app->flash('global', 'Sorry, there was an error uploading your file.');
      }
      return $app->response->redirect($app->urlFor('advert.add'));
  }
})->name('advert.upload.post');

