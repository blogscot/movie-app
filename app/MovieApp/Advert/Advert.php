<?php

namespace MovieApp\Advert;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Advert extends Eloquent {
  protected $table = 'adverts';

  protected $fillable = [
    'title',
    'price',
    'image_url',
    'category',
    'description',
    'expires_on',
    'isSold',
    'seller_id'
  ];

  public function calc_daily_rate($description) {
    // 50 words = 10p per day, 1 image = 10p per day
    return round(str_word_count($description) / 500 + 0.1, 2, PHP_ROUND_HALF_UP);
  }

  public function get_all() {
    return $this->get();
  }

  public function get_items($amount=8, $orderBy="title", $order="asc") {
    return $this
      ->orderBy($orderBy, $order)
      ->take($amount)->get();
  }

  // find an advert by its id
  public function find_by_id($id) {
    return $this->where('id', $id)->first();
  }

  // get a filtered list of adverts, by username, category or title
  public function find_by($search_term, $orderBy="price", $order="asc") {
    return $this
      ->join('users', 'users.id', '=', 'adverts.seller_id')
      ->where('username', 'like', '%'.$search_term.'%')
      ->orWhere('category', 'like', '%'.$search_term.'%')
      ->orWhere('title', 'like', '%'.$search_term.'%')
      ->orderBy($orderBy, $order)
      ->get();
  }

  // returns true if an advert is out of date, or expired
  public function hasExpired() {
    $expiry = date($this->expires_on);
    $now = date("Y-m-d H:i:s");

    return $expiry < $now;
  }

  // Relationships

  public function advert() {
    return $this->belongsTo('User');
  }
}