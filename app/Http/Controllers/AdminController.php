<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

	public function __construct()
	{
		$this->middleware('Role:' . config('app.admin_role') . '-' . config('app.secretary_role'));
	}

    public function show()
    {
    	return view('theme.backoffice.pages.admin.show');
    }
}
