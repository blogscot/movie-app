<?php

namespace MovieApp\Transaction;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Transaction extends Eloquent {
  protected $table = 'transactions';

  protected $fillable = [
    'title',
    'reason',
    'buyer_id',
    'seller_id',
    'amount',
    'balance',
  ];

  // Relationships

  public function transaction() {
    return $this->belongsTo('User');
  }

}