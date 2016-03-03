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
    'seller_id'
  ];

  public function calculate_ad_rate($description) {
    return str_word_count($description) / 12 + 10;
  }

  public function order_by_filter($filter) {
    return $this->orderBy($filter, 'asc')->get();
  }

  // Relationships
  public function advert() {
    return $this->belongsTo('User');
  }
}