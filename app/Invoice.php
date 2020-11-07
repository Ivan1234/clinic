<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Invoice extends Model
{
    protected $fillable = [
    	'amount', 'status', 'user_id'
    ];

    #RELACIONES
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function appointment()
    {
    	return $this->hasOne('App\Appointment');
    }

    public function metas()
    {
    	return $this->hasMany('App\InvoiceMeta');
    }
    #ALMACENAMIENTO

    public function store($request)
    {
        $user = User::findOrFail(decrypt($request->user_id));
    	return self::create([
    		'amount' => 500,
    		'status' => 'pending',
    		'user_id' => $user->id
    	]);
    }

    #RECUPERACIÓN DE INFORMACIÓN
    public function meta($key, $default=null)
    {
        $value = $this->metas->where('key', $key)->first();
        if(is_null($value)){
            $value = $default;
        }
        else{
            $value = $value->value;
        }

        return $value;
    }

    public function concept()
    {   
        return $this->meta('concept', 'Sin especificar');
    }

    public function doctor($default = 'Sin especificar')
    {
        $userid = $this->meta('doctor', 'Sin especificar');
        $user = User::findOrFail($userid);
        return $user;
    }

    public function status()
    {

    }
}
