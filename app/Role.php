<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Role extends Model
{
    protected $fillable = ['name', 'slug', 'description'];

    //RELACIONES
    public function permissions(){
    	return $this->hasMany('App\Permission');
    }

    public function user(){
    	return $this->belongsToManny('App\User')->withTimestamps();
    }

    //ALMACENAMIENTO
    public function store($request)
    {
    	$slug = Str::slug($request->name, '-');
        alert('Éxito','Se creó un nuevo rol', 'success')->showConfirmButton();
    	return self::create($request->All() + [
    		'slug' => $slug,
    	]);
    }

    public function my_update($request)
    {
        $slug = Str::slug($request->name, '-');
        alert('Éxito','El rol se ha actualizado', 'success')->showConfirmButton();
        self::update($request->all() + [
            'slug' => $slug,
        ]);
    }
}
