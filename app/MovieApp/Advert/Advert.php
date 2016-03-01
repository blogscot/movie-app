<?php

namespace MovieApp\Advert;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Advert extends Eloquent {
  protected $table = 'adverts';

  protected $fillable = [
    'title',
    'price',
    'category',
    'description',
    'ad_rate',
    'isSold',
    'user_id'
  ];

  public function advert() {
    return $this->belongsTo('User');
  }
}