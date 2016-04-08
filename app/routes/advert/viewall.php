<?php

$app->get('/viewadverts', function() use ($app) {
  $adverts = $app->advert->get_all();

  $app->render('advert/viewall.twig', [
    'adverts' => $adverts
  ]);
})->name('advert.viewall');

$app->post('/viewadverts', function() use ($app) {
  $orderBy = "price";
  $request = $app->request;

  $search_term = $request->post('search_term');
  $order = $request->post('order');
  $adverts = $app->advert->find_by($search_term, $orderBy, $order);

  $app->render('advert/viewall.twig', [
    'adverts' => $adverts
  ]);
})->name('advert.viewall.post');
