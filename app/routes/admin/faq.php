<?php

$app->get('/faq', function() use($app){
   return $app->render('admin/faq.twig');
})->name('admin.faq');
