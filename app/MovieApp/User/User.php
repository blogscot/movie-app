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

  // get all users
  public function get_all_users() {
   return $this->get();
  }

   // Get the user using their user $id
  public function getUserById($id) {
    $user = $this->where('id', $id)->first();
    return $user;
  }

   // Get the username for the a user's $id
   public function getUsernameById($id) {
      $user = $this->getUserById($id);
      return $user->username;
   }

   // Delete the users account.
   // Transaction records are not deleted.
   public function deleteAccount() {
     // let's assume, no monies refunded
     $this->wallet()->delete();
     $this->adverts()->delete();
     $this->permissions()->delete();
     return $this->delete();
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
       ->leftjoin('adverts', 'adverts.id', '=', 'transactions.advert_id')
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
