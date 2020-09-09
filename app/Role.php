<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'salug', 'description'];

    //RELACIONES
    public function permissions(){
    	return $this->hasMany('App\Permission');
    }

    public function user(){
    	return $this->belongsToManny('App\User')->withTimestamps();
    }
}
