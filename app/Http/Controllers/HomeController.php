<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bus;
use App\Models\Trip;
use App\Models\User;
use App\Models\Driver;
use App\Models\Parcel;
use App\Models\Booking;
use App\Models\Location;
use App\Models\Condition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function dashboard()
    {
        $book_seats = DB::table('bookings')
                ->join('trips', 'trips.trip_id', 'bookings.trip_id')
                ->groupBy('bookings.trip_id')  // Specify bookings.trip_id
                ->selectRaw('sum(seat_count) as sum, bookings.trip_id')
                ->pluck('sum','bookings.trip_id')->toArray();

        $trips = Trip::orderBy('trip_id', 'desc')
        ->join('drivers', 'drivers.driver_id', '=', 'trips.driver_id')
        ->join('buses', 'buses.bus_id', '=', 'trips.bus_id')
        ->where('trip_available', 'Yes')
        ->where('trip_date','>',Carbon::now()->toDateTimeString())
        ->select('trips.*', 'drivers.*', 'buses.*')
        ->get();

        $arr2 = []; // Initialize as empty array
        foreach ($trips as $tps){
            $arr2[] = $tps->trip_id;
        }

        $bkn = null;
        if (!empty($arr2)) {
            $bkn = Trip::whereIn('trip_id', $arr2)->withCount('bookings')->first();
        }

        $drivers = Driver::all();
        $locations = Location::all();
        $buses = Bus::all();
        $trip_id = Trip::select('trip_id')->get();

        return view('home.index', compact('drivers', 'trips', 'locations', 'buses', 'trip_id', 'book_seats', 'arr2', 'bkn'));
    }


    public function view_trip($id)
    {

        $user_id = Auth::id();
        $user_name = Auth::user()->name;
        $user_email = Auth::user()->email;
        $user_phone = Auth::user()->phone;
        $drivers = Driver::all();
        $locations = Location::all();
        $buses = Bus::all();
        $bookings = Booking::all();
        $count_trips = Trip::count();
        $trip_amount = Trip::select('fare')->findOrFail($id);
        $trips = Trip::find($id)->bookings;

        // $newArray = [1, 4];

        $newArray = [];
        foreach($trips as $seat){
            $seat_explode = explode(',', $seat->booking_seat);
            $newArray[] = $seat_explode;
            //$newArray[] = $seat->booking_seat;
        }    

        //$users = Trip::withCount('bookings')->get();
        // $users = User::find($user_id)->bookings;

        $trip = Trip::join('drivers', 'drivers.driver_id', '=', 'trips.driver_id')
        ->join('buses', 'buses.bus_id', '=', 'trips.bus_id')
        ->select('trips.*', 'drivers.*', 'buses.*')->findOrFail($id);

        $seat_number = $trip->seat_number;
        
        return view('home.create', compact('user_name', 'user_email', 'user_phone', 'drivers', 'trip', 'trip_amount', 'seat_number', 'locations', 'buses', 'bookings', 'count_trips', 'trips', 'newArray'));

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
      
        
        return view('home.search', compact('trips', 'locations', 'book_seats', 'arr2', 'bkn'));

    }



    public function view_seats()
    {
        $trip_id = Trip::select('trip_id')->get();
        $trip = Trip::all();
        $trips = Trip::orderBy('trip_name', 'asc')
                ->join('drivers', 'drivers.driver_id', '=', 'trips.driver_id')
                ->join('buses', 'buses.bus_id', '=', 'trips.bus_id')
                ->select('trips.*', 'drivers.*', 'buses.*')
                ->paginate(12);
            return view('home.seats', compact('trips', 'trip', 'trip_id'));

    }
    

    //AJAX TEST
    public function ajax_locations()
    {
        $locations = Location::all();
        $user_role = Auth::user()->role_id;
        if($user_role == 1 || $user_role == 2 || $user_role == 3)
        {
            return view('admin.locations.ajax', compact('locations'));
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }
    }


    public function send_ajax(Request $request)
    {
        $data = new location;
        // $location->location_name=$request->location_name;

        $data = $request->validate([
            'location_name' => 'required'
        ]);

        Location::create($data);

        return response()->json(['success'=>'Laravel ajax example is being processed.']);

        //return redirect()->back()->with('message', 'Location Added Successfully');


    }


    public function home_parcels(Request $request)
    {

        return view('home_parcels.index');

    }


    public function search_parcel(Request $request)
    {
        $this->validate($request, [
            'phone_number' => 'required',
            'tracking_code' => 'required',
        ]);

        $phone_number = $request->phone_number;
        $tracking_code = $request->tracking_code;

        $parcel = Parcel::where('sender_phone', 'Like', '%' .$phone_number. '%')
        ->where('tracking_code', 'Like', '%' .$tracking_code. '%')
        ->get();
        
        return view('home_parcels.search', compact('parcel'));

    }


    public function terms(Request $request)
    {
        return view('terms');
    }

    public function privacy_policy(Request $request)
    {
        return view('privacy');
    }
}
