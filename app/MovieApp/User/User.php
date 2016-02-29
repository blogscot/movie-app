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
      'email',
      'password',
   ];

   public function hasPermission($permission){
      return (bool) $this->permissions->{$permission};
   }

   public function isAdmin(){
     return $this->hasPermission('is_admin');
   }

   public function getFullName(){
      return "{$this->firstname} {$this->surname}";
   }

   public function getUsername(){
      return $this->username;
   }

   // Relationships

   public function permissions(){
      return $this->hasOne('MovieApp\User\User_Permission', 'user_id');
   }

   public function adverts() {
     return $this->hasOne('MovieApp\Advert\Advert', 'user_id');
   }
}