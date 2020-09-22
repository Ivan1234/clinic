<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Permission extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'role_id'];

    //RELACIONES
    public function role(){
    	return $this->belongsTo('App/Role');
    }

    public function users(){
    	return $this->belongsToMany('App/User')->withTimestamps();
    }

    //ALMACENAMIENTO
    public function store($request)
    {
        $slug = Str::slug($request->name, '-');
        alert('Éxito','Se creó un nuevo permiso', 'success')->showConfirmButton();
        return self::create($request->All() + [
            'slug' => $slug,
        ]);
    }

    //VALIDACIÓN

    //RECUPERACIÓN DE INFORMACIÓN

    //OTRAS OPERACIONES
}
