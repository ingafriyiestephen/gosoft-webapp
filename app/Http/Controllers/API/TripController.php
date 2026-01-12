<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Bus;
use App\Models\Trip;
use App\Models\Driver;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trips = Trip::orderBy('trip_id', 'desc')
        ->where('trip_available', 'Yes')
        ->where('trip_date','>',Carbon::now()->toDateTimeString())
        ->join('drivers', 'drivers.driver_id', '=', 'trips.driver_id')
        ->join('buses', 'buses.bus_id', '=', 'trips.bus_id')
        ->select('trips.*', 'drivers.*', 'buses.*')
        ->get();

        
        return $trips;
    
    }    
    
    public function trip_test()
    {
        $trips = Trip::orderBy('trip_id', 'desc')
        ->where('trip_available', 'No')
        ->where('trip_date','>',Carbon::now()->toDateTimeString())
        ->join('drivers', 'drivers.driver_id', '=', 'trips.driver_id')
        ->join('buses', 'buses.bus_id', '=', 'trips.bus_id')
        ->select('trips.*', 'drivers.*', 'buses.*')
        ->get();

        
        return $trips;
    
    }
    
    

    public function locations()
    {
        //
        return Location::all();
    }

    public function search_trip(Request $request)
    {
        $this->validate($request, [
            'departure' => 'required',
            'destination' => 'required',
            'trip_date' => 'required',
        ]);

        $locations = Location::all();
        $departure = $request->departure;
        $destination = $request->destination;
        $trip_date = $request->trip_date;

        
        $book_seats = DB::table('bookings')
                 ->groupBy('trip_id')
                 ->join('trips', 'trips.trip_id', 'bookings.trip_id')
                 ->selectRaw('sum(seat_count) as sum, bookings.trip_id')
                 ->pluck('sum','bookings.trip_id')->toArray();

        $trips = Trip::orderBy('trip_id', 'desc')
        ->join('drivers', 'drivers.driver_id', '=', 'trips.driver_id')
        ->join('buses', 'buses.bus_id', '=', 'trips.bus_id')
        ->select('trips.*', 'drivers.*', 'buses.*')
        ->where('departure', 'Like', '%' .$departure. '%')
        ->where('destination', 'Like', '%' .$destination. '%')
        ->where('trip_date', 'Like', '%' .$trip_date. '%')
        ->get();


        $arr2[] = '';
        foreach ($trips as $tps){
            $arr2[] = $tps->trip_id;
        }

        $bkn = Trip::where('trip_id', $arr2)->withCount('bookings')->first();

        return $trips;

    }


    public function view_trip($id)
    {

        // $user_id = Auth::id();
        // $user_name = Auth::user()->name;
        // $user_email = Auth::user()->email;
        // $user_phone = Auth::user()->phone;
        $drivers = Driver::all();
        $locations = Location::all();
        $buses = Bus::all();
        $count_trips = Trip::count();
        $trip_amount = Trip::select('fare')->findOrFail($id);
        $trips = Trip::find($id)->bookings;

        $newArray = [];
        foreach($trips as $seat){
            $seat_explode = explode(',', $seat->booking_seat);
            $newArray[] = $seat_explode;
        }    


        $trip = Trip::join('drivers', 'drivers.driver_id', '=', 'trips.driver_id')
        ->join('buses', 'buses.bus_id', '=', 'trips.bus_id')
        ->select('trips.*', 'drivers.*', 'buses.*')->findOrFail($id);

        return response()->json([
            'drivers'=> $drivers,
            'trip'=> $trip,
            'trip_amount' => $trip_amount,
            'locations' => $locations,
            'buses' => $buses,
            'count_trips' => $count_trips,
            'trips' => $trips,
            'newArray' => $newArray,
        ]);

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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        //
    }
}
