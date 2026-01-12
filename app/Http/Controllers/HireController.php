<?php

namespace App\Http\Controllers;

use App\Models\Hire;
use App\Mail\BusHired;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        $user_role = Auth::user()->role_id;
        $data = Hire::latest()->get();
        return view('admin.hires.index', compact('data', 'user', 'user_role'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('home.hire-bus');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $hire = new hire;
        $hire->company_name=$request->company_name;
        $hire->company_email=$request->company_email;
        $hire->company_phone=$request->company_phone;
        $hire->contact_phone=$request->contact_phone;
        $hire->from_location=$request->from_location;
        $hire->to_location=$request->to_location;
        $hire->number_days=$request->number_days;
        $hire->number_people=$request->number_people;
        $hire->purpose=$request->purpose;
        $hire->hire_date=$request->hire_date;
        $hire->note=$request->note;

        $hire->save();


        return redirect()->back()->with('message', 'Your request for a quote was sent successfully. You will be contacted shortly concerning the status of your request.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hire  $hire
     * @return \Illuminate\Http\Response
     */
    public function show(Hire $hire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hire  $hire
     * @return \Illuminate\Http\Response
     */
    public function edit(Hire $hire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hire  $hire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hire $hire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hire  $hire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hire $hire)
    {
        //
    }
}
