<?php

namespace MovieApp\Validation;

use Violin\Violin;

use MovieApp\User\User;
use MovieApp\Helpers\Hash;

class Validator extends Violin{
   protected $user;
   protected $hash;
   protected $auth;

   public function __construct(User $user, Hash $hash, $auth = null){
      $this->user = $user;
      $this->hash = $hash;
      $this->auth = $auth;;
   }

   public function validate_uniqueUsername($value, $input, $args){
      return ! (bool) $this->user->where('username', $value)->count();
   }

   public function validate_uniqueEmail($value, $input, $args){
      $user = $this->user->where('email', $value);

      if($this->auth && $this->auth->email === $value){
         return true;
      }

      return ! (bool) $user->count();
   }
}