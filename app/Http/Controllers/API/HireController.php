<?php

namespace App\Http\Controllers\API;

use App\Models\Hire;
use App\Mail\BusHired;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $messages = [
            'company_name.required' => 'Please provide the company/business name!',
            'company_email.required' => 'Please provide the company/business email!',
            'company_phone.required' => 'Please provide the company/business phone!',
            'contact_phone.required' => 'Please provide the phone number of the contact person',
            'from_location.required' => 'Please provide the from location/departure!',
            'to_location.required' => 'Please provide the to location/destination!',
            'number_days.required' => 'Please provide the number of days for the booking/hiring!',
            'number_people.required' => 'Please provide the total number of passengers!',
            'purpose.required' => 'Please select the purpose for the trip!',
            'hire_date.required' => 'Please select the hire date!',
        ];

        
        $validator = Validator::make($request->all(), [
            'company_name' => 'required',
            'company_email' => 'required|email:rfc,dns',
            'company_phone' => 'required|numeric|digits:10|',
            'contact_phone' => 'required|numeric|digits:10|',
            'from_location' => 'required',
            'to_location' => 'required',
            'number_days' => 'required',
            'number_people' => 'required',
            'purpose' => 'required',
            'hire_date' => 'required',
        ], $messages);


   
        if($validator->fails()){
            // return $this->sendError('Validation Error.', $validator->errors());       
                    $message = $validator->errors()->first();
                    return response()->json(['statusCode'=>200,'success'=>false,'message'=>$message], 200); 
        }


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

        $data = [
            'company_name'=>$request->company_name, 
            'company_email'=>$request->company_email, 
            'company_phone'=>$request->company_phone, 
            'contact_phone'=>$request->contact_phone, 
            'from_location'=>$request->from_location, 
            'to_location'=>$request->to_location, 
            'number_days'=>$request->number_days, 
            'number_people'=>$request->number_people, 
            'purpose'=>$request->purpose, 
            'hire_date'=>$request->hire_date, 
            'note'=>$request->note, 
        ];
        Mail::to($request->company_email)->send(new BusHired($data));

        return response()->json(['success'=>true,'message'=>'Your request for a quote was sent successfully. You will be contacted shortly concerning the status of your request.']); 
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
