<?php

namespace MovieApp\Advert;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Advert extends Eloquent {
  protected $table = 'adverts';

  protected $fillable = [
    'title',
    'price',
    'user_id'
  ];

  public function createAdvert($title, $price, $userId) {
    $advert = new Advert;
    $advert->title = $title;
    $advert->price = $price;
    $advert->user_id = $userId;
    $advert->save();
    return $advert->id;
  }

  public function deleteAdvert($advertId) {
    $advert = $this->find($advertId);
    return $advertId->delete();
  }
}