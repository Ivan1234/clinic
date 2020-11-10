<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
	protected $fillable = [
		'key', 'value', 'user_id',
	];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function disable_dates($request, $user)
	{
		//Ahora debemos procesar las fechas para que las podamos manipular con javascript.
		$disabled_dates = new DisableDate();
		$values = $disabled_dates->process_disabled_dates($request->multi_date_input);
		//Actualizar o almacenar las fechas
		DisableDate::updateOrCreate([
			'user_id' => $user->id
		],[
			'key' => 'manual',
			'value' => $values
		]);
	}

	public function disable_work_days($request, $user)
	{
		$days_off = implode('-',$request->week_days_off);
		//Actualizar o almacenar las fechas
		DisableDate::updateOrCreate([
			'user_id' => $user->id,
			'key' => 'days_off',
		],[
			'value' => $days_off
		]);
	}

}
