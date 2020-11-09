<?php

namespace App\Http\Controllers;

use App\User;
use App\Appointment;
use App\Invoice;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function schedule()
    {
    	return view('theme.frontoffice.pages.user.patient.schedule', [
            'user' => user(),
            'specialities' => \App\Speciality::all(),
        ]);
    }

    public function back_schedule(User $user)
    {
        return view('theme.backoffice.pages.user.patient.schedule', [
            'user' => $user,
            'specialities' => \App\Speciality::all()
        ]);
    }

    public function store_schedule(Request $request, Appointment $appointment, Invoice $invoice){
        $invoice = $invoice->store($request);
        $appointment = $appointment->store($request, $invoice);
        alert('Éxito', 'Cita creada', 'success')->showConfirmButton();
        return redirect()->route('frontoffice.patient.appointments');
    }

    /*
    * @todo Ver si se puede unificar los métodos de store_schedule() y de store_back_schedule()
    *
    */

    public function store_back_schedule(Request $request, User $user, Appointment $appointment, Invoice $invoice)
    {   
        $invoice = $invoice->store($request);
        $appointment = $appointment->store($request, $invoice);
        alert('Éxito', 'Cita creada', 'success')->showConfirmButton();
        return redirect()->route('backoffice.user.show', $user);   
    }

    public function appointments()
    {
        return view('theme.frontoffice.pages.user.patient.appointments', [
            'appointments' => user()->appointments->sortBy('date')
        ]);
    }

    public function back_appointments(User $user){
        if(user()->has_role(config('app.doctor_role'))){
            $appointments = $user->appointments->where('doctor_id', user()->id)->sortBy('date');
        }
        else{
            $appointments = $user->appointments->sortBy('date');
        }
        return view('theme.backoffice.pages.user.patient.appointment', [
            "user" => $user,
            'appointments' => $appointments
        ]);
    }

    public function show_appointments()
    {
        $appointments_collection = Appointment::all();
        $appointments = []; 

        foreach($appointments_collection as $key => $appointment)
        {
            $appointments[] = [
                'title' => $appointment->user->name . ' cita con ' . $appointment->doctor()->name,
                'start' => $appointment->date->format('Y-m-d\TH:i:s'),
                'url' => route('backoffice.patient.appointments.edit', [
                    $appointment->user,
                    $appointment
                ])
            ];
        }

        return view('theme.backoffice.pages.appointment.show', [
            'appointments'=> json_encode($appointments)
        ]);
    }

    public function show_doctor_appointments(User $user)
    {
        $this->authorize('view_appointments_calendar', $user);

        $appointments_collection = Appointment::where('doctor_id', $user->id)->get();
        $appointments = []; 

        foreach($appointments_collection as $key => $appointment)
        {
            $appointments[] = [
                'title' => $appointment->user->name . ' cita con ' . $appointment->doctor()->name,
                'start' => $appointment->date->format('Y-m-d\TH:i:s'),
                'url' => route('backoffice.patient.appointments.edit', [
                    $appointment->user,
                    $appointment
                ])
            ];
        }

        return view('theme.backoffice.pages.appointment.show', [
            'user' => $user,
            'appointments'=> json_encode($appointments)
        ]);   
    }

    public function back_appointments_edit(User $user, Appointment $appointment)
    {
        $this->authorize('edit_back_appointment', $appointment);
        return view('theme.backoffice.pages.user.patient.appointment_edit', [
            'user' => $user,
            'appointment' => $appointment
        ]);
    }

    public function back_appointments_update(Request $request, User $user, Appointment $appointment)
    {
        $this->authorize('edit_back_appointment', $appointment);
        $appointment->my_update($request);
        alert('Éxito', 'Cita actualizada', 'success')->showConfirmButton();
        return redirect()->route('backoffice.user.show', $user);
    }

    public function prescriptions()
    {
        return view('theme.frontoffice.pages.user.patient.prescriptions');
    }

    public function invoices()
    {
        return view('theme.frontoffice.pages.user.patient.invoices', [
            'invoices' => user()->invoices
        ]);
    }

    public function back_invoices(User $user)
    {
        if(user()->has_role(config('app.doctor_role'))){
            $invoices = [];
            $user_invoices = $user->invoices;
            foreach($user_invoices as $key => $invoice){
                if($invoice->meta('doctor') == user()->id){
                    $invoices[] = $invoice;
                }
            }

            $invoices = collect($invoices);
        }
        else{
            $invoices = $user->invoices;
        }
        return view('theme.backoffice.pages.user.patient.invoice', [
            "user" => $user,
            'invoices' => $invoices
        ]);
    }

    public function back_invoice_edit(User $user, Invoice $invoice)
    {
        $this->authorize('edit_back_invoice', $invoice);
        return view('theme.backoffice.pages.invoice.edit', [
            'user' => $user,
            'invoice' => $invoice
        ]);
    }

    public function back_invoice_update(Request $request, User $user, Invoice $invoice)
    {
        $this->authorize('edit_back_invoice', $invoice);
        $invoice->my_update($request);
        alert('Éxito', 'Factura actualizada', 'success')->showConfirmButton();
        return redirect()->route('backoffice.user.show', $user);
    }
}
