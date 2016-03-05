<?php

namespace MovieApp\Transaction;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Transaction extends Eloquent {
  protected $table = 'transactions';

  protected $fillable = [
    'advert_id',
    'seller_id',
    'buyer_id'
  ];

  // returns the selected user's purchase details
  public function find_by_user($user_id) {
    return $this
      ->join('adverts', 'adverts.id', '=', 'transactions.advert_id')
      ->where('buyer_id', $user_id)
      ->get();
  }

  // Relationships

  public function transaction() {
    return $this->belongsTo('User');
  }

}