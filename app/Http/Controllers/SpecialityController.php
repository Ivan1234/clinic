<?php

namespace App\Http\Controllers;

use App\Speciality;
use App\Http\Requests\Speciality\StoreRequest;
use App\Http\Requests\Speciality\UpdateRequest;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('theme.backoffice.pages.speciality.index', [
            'specialities'=>Speciality::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('theme.backoffice.pages.speciality.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, Speciality $speciality)
    {
        $speciality = $speciality->store($request);
        return redirect()->route('backoffice.speciality.show', $speciality);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function show(Speciality $speciality)
    {
        return view('theme.backoffice.pages.speciality.show', [
            'speciality' => $speciality,
            'users' => $speciality->users
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function edit(Speciality $speciality)
    {
        return view('theme.backoffice.pages.speciality.edit', [
            'speciality' => $speciality
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Speciality $speciality)
    {
        $speciality->my_update($request);
        return redirect()->route('backoffice.speciality.show', $speciality);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Speciality  $speciality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Speciality $speciality)
    {
        $speciality->delete();
        return redirect()->route('backoffice.speciality.index');
    }
}
