<?php

$app->get('/viewadverts', function() use ($app) {
  $filter = 'category';
  $adverts = $app->advert->order_by_filter($filter);

  $app->render('advert/viewall.twig', [
    'adverts' => $adverts
  ]);
})->name('advert.viewall');

$app->post('/viewadverts', function() use ($app) {
  $request = $app->request;

  $filter = $request->post('filter');
  $adverts = $app->advert->order_by_filter($filter);

  $app->render('advert/viewall.twig', [
    'adverts' => $adverts
  ]);
})->name('advert.viewall.post');
