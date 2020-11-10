<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function user_speciality(Request $request)
    {
    	if($request->ajax()){
    		$speciality = \App\Speciality::findOrFail($request->speciality);
    		$users = $speciality->users;
    		return response()->json($users);
    	}
    }

    public function invoice_info(Request $request)
    {
    	if($request->ajax())
    	{
    		$invoice = \App\Invoice::findOrFail($request->invoice_id);
    		return response()->json([
    			'invoice' => $invoice,
    			'doctor' => $invoice->doctor('No aplica'),
    			'concept' => $invoice->concept()
    		]);
    	}
    }

    public function note_info(Request $request)
    {
        if($request->ajax()){
            $note = \App\ClinicNote::findOrFail($request->note_id);
            return response()->json([
                'route' => route('backoffice.clinic_note.update', [$note->user, $note]),
                'description' => $note->description,
                'privacy' => $note->privacy
            ]);
        }
    }

    public function disable_dates(Request $request)
    {
        if($request->ajax()){
            $user = \App\User::findOrFail($request->doctor);
            return response()->json([
                'disable_dates' => $user->manual_disabled_dates(),
                'days_off' => $user->days_off(),
            ]);
        }
    }
}
