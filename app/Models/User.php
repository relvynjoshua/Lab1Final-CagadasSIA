<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class User extends Model 
{
public $timestamps = false; 
  
protected $primaryKey = 'usernum';  
  
protected $table = 'tbluser'; 
  
protected $fillable = [ 
    'usernum', 'username', 'password' 
]; 
}
