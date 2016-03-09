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

  // Relationships

  public function transaction() {
    return $this->belongsTo('User');
  }

}