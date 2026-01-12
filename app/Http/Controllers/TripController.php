<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Trip;
use App\Models\Driver;
use App\Models\Location;
use App\Models\Condition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TripController extends Controller
{
    //
    public function trips()
    {
        $drivers = Driver::where('condition', 'Available')->get();
        $locations = Location::all();
        $buses = Bus::where('condition', 'Available')->get();
                 
        $trips = DB::table('trips')
        ->join('drivers', 'drivers.driver_id', '=', 'trips.driver_id')
        ->join('buses', 'buses.bus_id', '=', 'trips.bus_id')
               ->select('trips.*', 'drivers.*', 'buses.*')
          ->orderBy('trips.trip_id', 'desc')
        ->get();
                 
        $user_role = Auth::user()->role_id;
        $user = Auth::user();
        if($user_role == 0 || $user_role == 1 || $user_role == 2 || $user_role == 3)
        {
            return view('admin.trips.index', compact('user', 'user_role', 'drivers', 'trips', 'locations', 'buses'));
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }
    }


    public function store_trip(Request $request)
    {
        $user_role = Auth::user()->role_id;
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->name;
        $validatedData = $request->validate([
        'trip_date' => 'required',
        'trip_end_date' => 'required',
        'start_time' => 'required',
        'end_time' => 'required',
        'departure' => 'required',
        'destination' => 'required',
        'fare' => 'required',
        ]);
        
        if($request->bus_id == ''){
            return redirect()->back()->with('failure', 'The bus field is required!');
        }elseif($request->driver_id == ''){
            return redirect()->back()->with('failure', 'The driver field is required!');
        }
        
        
        if($request->departure == $request->destination){
            return redirect()->back()->with('failure', 'The departure and destination fields cannot be the same!');
        }
        
        
        
        $trip= new trip;

        if (Trip::exists()) {      
            $trip_number = Trip::orderBy('trip_id', 'desc')->first()->trip_id + 1;
        } else {
            $trip_number = 1;
        }

        $trip->trip_name=substr(strtoupper($request->departure), 0, 2) . substr(strtoupper($request->destination), 0, 2) . $trip_number;
        $trip->trip_date=$request->trip_date . ' ' . $request->start_time;
        $trip->trip_end_date=$request->trip_end_date;
        $trip->start_time=$request->start_time;
        $trip->end_time=$request->end_time;
        $trip->departure=$request->departure;
        $trip->destination=$request->destination;
        $trip->fare=$request->fare;
        $trip->bus_id=$request->bus_id;
        $trip->driver_id=$request->driver_id;
        $trip->trip_status=$request->trip_status;
        $trip->created_by=$user_name;
        $trip->creator_id=$user_id;


        if($user_role == 0 || $user_role == 1 || $user_role == 2 || $user_role == 3)
        {
            $trip->save();
            return redirect()->back()->with('message', 'Trip Added Successfully');
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }
    }



    public function edit_trip($id)
    {
        //
        $drivers = Driver::all();
        $locations = Location::all();
        $buses = Bus::all();
        $user_role = Auth::user()->role_id;
        $user = Auth::user();
        $trip = Trip::join('drivers', 'drivers.driver_id', '=', 'trips.driver_id')
        ->join('buses', 'buses.bus_id', '=', 'trips.bus_id')
        ->select('trips.*', 'drivers.*', 'buses.*')->findOrFail($id);
        
        list($first) = explode(" ", $trip->trip_date);
        
        list($last) = explode(" ", $trip->trip_end_date);

        if($user_role == 0 || $user_role == 1 || $user_role == 2 || $user_role == 3)
        {

            $conditions = Condition::all();
            return view('admin.trips.edit', compact('user', 'user_role', 'drivers', 'trip', 'first', 'last', 'locations', 'buses'));
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }

    }


    public function update_trip(Request $request, $id)
    {
        //
        $user_role = Auth::user()->role_id;
        $validatedData = $request->validate([
            'trip_name' => 'required|max:10',
            'trip_date' => 'required',
            'trip_end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'departure' => 'required',
            'destination' => 'required',
            'fare' => 'required',
            'bus_id' => 'required',
            'driver_id' => 'required',
        ]);

        if($user_role == 0 || $user_role == 1 || $user_role == 2 || $user_role == 3)
        {
            $trip = Trip::findOrFail($id);
            
            
    //  $trip->trip_name=substr(strtoupper($request->departure), 0, 2) . substr(strtoupper($request->destination), 0, 2) . $trip_number;
        $trip->trip_date=$request->trip_date . ' ' . $request->start_time;
        $trip->trip_end_date=$request->trip_end_date;
        $trip->start_time=$request->start_time;
        $trip->end_time=$request->end_time;
        $trip->departure=$request->departure;
        $trip->destination=$request->destination;
        $trip->fare=$request->fare;
        $trip->bus_id=$request->bus_id;
        $trip->driver_id=$request->driver_id;
        $trip->trip_status=$request->trip_status;
        $trip->trip_available=$request->trip_available;

            $trip->save();
            return redirect()->back()->with('message', 'Trip updated Successfully');
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }

    }



    public function delete_trip($id)
    {
        //
        $user_role = Auth::user()->role_id;
        if($user_role == 0 || $user_role == 1 || $user_role == 2 || $user_role == 3)
        {
            $trip = Trip::findOrFail($id);
            $trip->delete();
            return redirect()->back()->with('message', 'Trip deleted Successfully');
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }

    }
}
