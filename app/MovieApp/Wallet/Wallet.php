<?php

namespace MovieApp\Wallet;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Wallet extends Eloquent {
  protected $table = 'wallets';

  protected $fillable = [
    'balance',
    'user_id'
  ];

  public function get_wallet($id) {
    return $this->where('user_id', $id)->first();
  }

  // Relationships

  public function wallet() {
    return $this->belongsTo('User');
  }
}