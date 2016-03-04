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

  public function get_all() {
    return $this->get();
  }

  // find an advert by its id
  public function find_by_id($id) {
    return $this->where('id', $id)->first();
  }

  // return all the adverts from a seller using their $id
  public function find_by_seller($id) {
    return $this->where('seller_id', $id)->get();
  }

  // get a filtered list of adverts, by username, category or title
  public function find_by($search_term) {
    return $this
      ->join('users', 'users.id', '=', 'adverts.seller_id')
      ->where('username', 'like', '%'.$search_term.'%')
      ->orWhere('category', 'like', '%'.$search_term.'%')
      ->orWhere('title', 'like', '%'.$search_term.'%')
      ->get();
  }

  // Relationships

  public function advert() {
    return $this->belongsTo('User');
  }
}