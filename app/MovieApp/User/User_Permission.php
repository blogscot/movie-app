<?php

namespace MovieApp\User;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User_Permission extends Eloquent{
   protected $table = 'user_permissions';

   protected $fillable = [
      'is_admin'
   ];

   public static $defaults = [
      'is_admin' => false
   ];
}