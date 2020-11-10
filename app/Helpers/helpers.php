<?php 
if(!function_exists('active_class'))
{
	function active_class($url)
	{
		$current_url = url()->current();
		if($url == $current_url)
		{
			return 'active';
		}
	}
}

if(!function_exists('user'))
{
	function user()
	{
		return auth()->user();
	}
}

if(!function_exists('carbon_format'))
{
	function carbon_format($date, $format = 'Y-m-d')
	{
		if(!is_null($date)){
			$date = \Carbon\Carbon::parse($date)->format($format);
			return $date;
		}else{
			return null;
		}
	}
}

?>