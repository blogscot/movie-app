<?php

namespace MovieApp\User;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent{
   protected $table = 'users';

   protected $fillable = [
      'username',
      'password',
      'firstname',
      'surname',
      'email'
   ];

   public function hasPermission($permission){
      return (bool) $this->permissions->{$permission};
   }

   // is the current user an Admin user?
   public function isAdmin(){
     return $this->hasPermission('is_admin');
   }

   // Get the current user's full name
   public function getFullName(){
      return "{$this->firstname} {$this->surname}";
   }

   // Get the current user's username
   public function getUsername(){
      return $this->username;
   }

   // Get the username for the a user's $id
   public function getUsernameById($id) {
      $user = $this->where('id', $id)->first();
      return $user->username;
   }

   // Relationships

   public function permissions(){
      return $this->hasOne('MovieApp\User\User_Permission', 'user_id');
   }

   public function adverts() {
     return $this->hasMany('MovieApp\Advert\Advert', 'seller_id');
   }

   public function transactions_adverts() {
     return $this
       ->join('transactions', 'users.id', '=', 'transactions.buyer_id')
       ->join('adverts', 'adverts.id', '=', 'transactions.advert_id')
       ->where('users.id', $this->id)
       ->get();
   }

  public function transactions() {
    return $this->hasMany('MovieApp\Transaction\Transaction', 'buyer_id');
  }

  public function wallet() {
    return $this->hasOne('MovieApp\Wallet\Wallet');
  }
}
