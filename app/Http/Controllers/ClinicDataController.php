<?php

namespace App\Http\Controllers;

use App\ClinicData;
use App\User;
use Illuminate\Http\Request;

class ClinicDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return view('theme.backoffice.pages.user.patient.clinicdata.index',[
            'user' => $user,
            'datas' => $user->clinic_data_array(),
            'clinic_notes' => $user->clinic_notes->sortByDesc('created_at')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        return view('theme.backoffice.pages.user.patient.clinicdata.form', [
            'user' => $user,
            'datas' => $user->clinic_data_array()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user, ClinicData $clinic_data)
    {
        $clinic_data->store($request, $user);
        return redirect()->route('backoffice.clinic_data.index', $user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClinicData  $clinicData
     * @return \Illuminate\Http\Response
     */
    public function show(ClinicData $clinicData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClinicData  $clinicData
     * @return \Illuminate\Http\Response
     */
    public function edit(ClinicData $clinicData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClinicData  $clinicData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClinicData $clinicData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClinicData  $clinicData
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClinicData $clinicData)
    {
        //
    }
}
