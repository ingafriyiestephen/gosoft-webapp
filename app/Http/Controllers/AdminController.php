<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Bus;
use App\Models\Trip;
use App\Models\User;
use App\Models\Driver;
use App\Models\Parcel;
use App\Models\Booking;
use App\Models\Hire;
use App\Models\Location;
use App\Models\Condition;
use App\Models\ParcelType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    //Create public variables
    public $new_location;
    public $new_trip;
    public $new_bus;
    public $new_driver;
    public $new_booking;
    public $new_user;
    public $session_email;
    public $session_trip;

    public function booking_dashboard(){
    //
    $user = Auth::user();
    $users = User::count();
    $data = User::all();
    $team = User::where('role_id', 0)->orWhere('role_id', 1)->orWhere('role_id', 2)->orWhere('role_id', 3)->count();
    $locations = Location::count();
    $drivers = Driver::count();
    $buses = Bus::count();

    $today = Carbon::today();
    $trips_today = Trip::whereDate('created_at', $today)->count();
    $bookings_today = Booking::whereDate('created_at', $today)->count();
    $hirings_today = Hire::whereDate('created_at', $today)->count();
    $customers_today = User::where('role_id', 0)->whereDate('created_at', $today)->count();


    if (request()->start_date || request()->end_date) {
        $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
        $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
        
        $total_confirmed = DB::table('bookings')->join('trips', 'trips.trip_id', '=', 'bookings.trip_id')->whereBetween('bookings.created_at',[$start_date,$end_date])->where('status', 'Confirmed')->sum('booking_amount');
        $total_pending = DB::table('bookings')->join('trips', 'trips.trip_id', '=', 'bookings.trip_id')->whereBetween('bookings.created_at',[$start_date,$end_date])->where('status', 'Pending')->sum('booking_amount');
        $bookings = Booking::whereBetween('created_at',[$start_date,$end_date])->count();
        $trips = Trip::whereBetween('created_at',[$start_date,$end_date])->count();
        $count_pending = Booking::whereBetween('created_at',[$start_date,$end_date])->where('status',  'Pending')->count();
        $count_confirmed = Booking::whereBetween('created_at',[$start_date,$end_date])->where('status',  'Confirmed')->count();
        $parcels = Parcel::whereBetween('created_at',[$start_date,$end_date])->count();
        $hirings = Hire::whereBetween('created_at',[$start_date,$end_date])->count();
        $count_customers = Booking::where('role_id', 0)->whereBetween('created_at',[$start_date,$end_date])->pluck('customer_phone')->unique()->count();
    
        $filter_result = "Results for: ". ''.$start_date. ' '. '-'.$end_date;
    }elseif(request()->all_data){
        // dd(request()->all_data == 'all_data');
        $start_date = '';
        $end_date = '';
        $total_pending = Booking::where('status', 'Pending')->sum('booking_amount');
        $total_confirmed = Booking::where('status', 'Confirmed')->sum('booking_amount');
        $bookings = Booking::count();
        $trips = Trip::count();
        $count_pending = Booking::where('status', 'Pending')->count();
        $count_confirmed = Booking::where('status', 'Confirmed')->count();
        $parcels = Parcel::count();
        $hirings = Hire::count();
        $count_customers = Booking::where('role_id', 0)->pluck('customer_phone')->unique()->count();
        $filter_result = "Results for all data";
    
    }else{
        $start_date = '';
        $end_date = '';
        $total_pending = Booking::whereDate('created_at', $today)->where('status', 'Pending')->sum('booking_amount');
        $total_confirmed = Booking::whereDate('created_at', $today)->where('status', 'Confirmed')->sum('booking_amount');
        $bookings = Booking::whereDate('created_at', $today)->count();
        $trips = Trip::whereDate('created_at', $today)->count();
        $count_pending = Booking::whereDate('created_at', $today)->where('status', 'Pending')->count();
        $count_confirmed = Booking::whereDate('created_at', $today)->where('status', 'Confirmed')->count();
        $parcels = Parcel::whereDate('created_at', $today)->count();
        $hirings = Hire::whereDate('created_at', $today)->count();
        $count_customers = Booking::where('role_id', 0)->whereDate('created_at', $today)->pluck('customer_phone')->unique()->count();

        // $filter_result = "Results for all data";
        $filter_result = "Today's data";
    
    }
   

    $user_role = Auth::user()->role_id;
    if ($user_role == 0 || $user_role == 1)
    {
        return view('admin.bookings.dashboard', compact('start_date', 'end_date', 'filter_result', 'customers_today', 'trips_today', 'bookings_today', 'hirings_today', 'total_confirmed', 'total_pending', 'locations', 'user', 'users', 'user_role',  'data', 'drivers', 'buses', 'trips', 'bookings', 'count_pending', 'count_confirmed', 'count_customers', 'parcels', 'hirings', 'team'));
    }
    else{
        return('You are not authorized to view this page. Please contact the administrator');
    }

    }



    public function locations()
    {
        $user = Auth::user();
        $locations = Location::orderBy('location_id', 'desc')
        ->get();
        $user_role = Auth::user()->role_id;
        if($user_role == 0 || $user_role == 1 || $user_role == 2 || $user_role == 3)
        {
            return view('admin.locations.index', compact('user', 'locations', 'user_role'));
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }
    }


    public function store_location(Request $request)
    {
        $user_role = Auth::user()->role_id;

        $validatedData = $request->validate([
            'location_name' => 'required|unique:locations|max:255',
        ]);


        if($user_role == 0 || $user_role == 1 || $user_role == 2 || $user_role == 3)
        {
            Location::create($validatedData);

            //Send Location Created Confirmation Email
            // $emails = ['webmuchogh@gmail.com', Auth::user()->email];
            // Mail::send('mail.location.location_added', [], function($message) use ($emails)
            // {    
            //     $message->to($emails)->subject('New Location Added'. ': ' .$this->new_location); 
            // });

            return redirect()->back()->with('message', 'Location Added Successfully');
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }
    }



    public function edit_location($id)
    {
        //
        $user = Auth::user();
        $user_role = Auth::user()->role_id;
        if($user_role == 0 || $user_role == 1 || $user_role == 2 || $user_role == 3)
        {
            $location = Location::findOrFail($id);
            return view('admin.locations.edit', compact('user', 'location', 'user_role'));
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }

    }


    public function update_location(Request $request, $id)
    {
        //
        $user_role = Auth::user()->role_id;
        if($user_role == 0 || $user_role == 1 || $user_role == 2 || $user_role == 3)
        {
            $location = Location::findOrFail($id);
            $location->location_name = $request->location_name;

            $location->save();
            return redirect()->back()->with('message', 'Location updated Successfully');
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }

    }



    public function delete_location($id)
    {
        //
        $user_role = Auth::user()->role_id;
        if($user_role == 0 || $user_role == 1 || $user_role == 2 || $user_role == 3)
        {
            $location = Location::findOrFail($id);
            $location->delete();
            return redirect()->back()->with('message', 'Location deleted Successfully');
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }

    }



    public function buses()
    {
        $user = Auth::user();
        $buses = Bus::all();
        $conditions = Condition::all();
        $user_role = Auth::user()->role_id;
        if($user_role == 0 || $user_role == 1 || $user_role == 2 || $user_role == 3)
        {
            return view('admin.buses.index', compact('user', 'buses', 'conditions', 'user_role'));
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }
    }


    public function store_bus(Request $request)
    {
        $user_role = Auth::user()->role_id;

        $request->validate([
            'bus_number' => 'required',
            'seat_number' => 'required',
            'condition' => 'required',
        ]);


        $bus= new bus;
            
        $bus->bus_number = $request->bus_number;
        $bus->seat_number = $request->seat_number;
        $bus->condition = $request->condition;
        $image=$request->bus_image;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->bus_image->move('bus', $imagename);
        $bus->bus_image=$imagename;
      

        if($user_role == 0 || $user_role == 1 || $user_role == 2 || $user_role == 3)
        {

            $bus->save();
            return redirect()->back()->with('message', 'Bus Added Successfully');
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }
    }



    public function edit_bus($id)
    {
        //
        $user = Auth::user();
        $user_role = Auth::user()->role_id;
        if($user_role == 0 || $user_role == 1 || $user_role == 2 || $user_role == 3)
        {
            // $bus = Bus::findOrFail($id);

            $bus = Bus::findOrFail($id);

            $conditions = Condition::all()
            ->sortBy('condition');
            return view('admin.buses.edit', compact('user', 'bus', 'conditions', 'user_role'));
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }

    }


    public function update_bus(Request $request, $id)
    {
        //
        $user_role = Auth::user()->role_id;
        $request->validate([
            'bus_number' => 'required',
            'seat_number' => 'required',
            'condition' => 'required',
        ]);
        if($user_role == 0 || $user_role == 1 || $user_role == 2 || $user_role == 3)
        {
            $bus = Bus::findOrFail($id);
            $bus->bus_number = $request->bus_number;
            $bus->seat_number = $request->seat_number;
            $bus->condition = $request->condition;

            $image = $request->bus_image;

            if ($image)
    
            {
                $imagename = time().'.'.$image->getClientOriginalExtension();
                $request->bus_image->move('bus', $imagename);
                $bus->bus_image=$imagename;
            }

            $bus->save();
            return redirect()->back()->with('message', 'Bus updated Successfully');
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }

    }



    public function delete_bus($id)
    {
        //
        $user_role = Auth::user()->role_id;
        if($user_role == 0 || $user_role == 1 || $user_role == 2 || $user_role == 3)
        {
            $bus = Bus::findOrFail($id);
            $bus->delete();
            return redirect()->back()->with('message', 'Bus deleted Successfully');
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }

    }


    public function drivers()
    {
        $user = Auth::user();
        $drivers = Driver::get();
        $locations = Location::all()
        ->sortBy('location_name');;
        $user_role = Auth::user()->role_id;
        if($user_role == 0 || $user_role == 1 || $user_role == 2 || $user_role == 3)
        {
            return view('admin.drivers.index', compact('user', 'drivers', 'locations', 'user_role'));
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }
    }


    public function store_driver(Request $request): RedirectResponse
    {
        $user_role = Auth::user()->role_id;

        $request->validate([
            'driver_name' => 'required|max:255',
            'phone' => 'required|unique:drivers|min:10|max:10',
            'location' => 'required|max:255',
            'license_number' => 'required|unique:drivers|max:255',
            'ghana_card_number' => 'required|unique:drivers|max:255',
            'condition' => 'required',
            'driver_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);



        $driver= new driver;
        $driver->driver_name=$request->driver_name;
        $driver->phone=$request->phone;
        $driver->location=$request->location;
        $driver->license_number=$request->license_number;
        $driver->ghana_card_number=$request->ghana_card_number;
        $driver->condition=$request->condition;


        $image=$request->driver_image;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->driver_image->move('driver', $imagename);
        $driver->driver_image=$imagename;


        if($user_role == 0 || $user_role == 1 || $user_role == 2 || $user_role == 3)
        {
            // Driver::create($validatedData);
            $driver->save();

            return redirect()->back()->with('message', 'Driver Added Successfully');
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }
    }


    public function edit_driver($id)
    {
        //
        $user = Auth::user();
        $user_role = Auth::user()->role_id;
        
        if($user_role == 0 || $user_role == 1 || $user_role == 2 || $user_role == 3)
        {
            $driver = Driver::findOrFail($id);
            $locations = Location::all()
            ->sortBy('location_name');;

            return view('admin.drivers.edit', compact('user', 'driver', 'locations', 'user_role'));
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }

    }


    public function update_driver(Request $request, $id): RedirectResponse
    {
        //
        $user_role = Auth::user()->role_id;

        $request->validate([
            'driver_name' => 'required|max:255',
            'phone' => 'required|min:10|max:10',
            'location' => 'required|max:255',
            'license_number' => 'required|max:255',
            'ghana_card_number' => 'required|max:255',
            'condition' => 'required',
        ]);

        if($user_role == 0 || $user_role == 1 || $user_role == 2 || $user_role == 3)
        {
            $driver = Driver::findOrFail($id);

            $driver->driver_name=$request->driver_name;
            $driver->phone=$request->phone;
            $driver->location=$request->location;
            $driver->license_number=$request->license_number;
            $driver->ghana_card_number=$request->ghana_card_number;
            $driver->condition=$request->condition;

            $image = $request->driver_image;

            if ($image)
    
            {
                $imagename = time().'.'.$image->getClientOriginalExtension();
                $request->driver_image->move('driver', $imagename);
                $driver->driver_image=$imagename;
            }

            $driver->save();
            // Driver::create($validatedData);
            return redirect()->back()->with('message', 'Driver updated Successfully');
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }

    }


    public function delete_driver($id)
    {
        //
        $user_role = Auth::user()->role_id;
        if($user_role == 0 || $user_role == 1 || $user_role == 2 || $user_role == 3)
        {
            $driver = Driver::findOrFail($id);
            $driver->delete();
            return redirect()->back()->with('message', 'Driver deleted Successfully');
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }

    }



    //
    public function admin_bookings()
    {
        $user = Auth::user();
        $user_role = Auth::user()->role_id;
        // $boking_relates = Trip::find(1)->bookings;
        $drivers = Driver::all();
        $locations = Location::all();
        $buses = Bus::all();
        $bookings = DB::table('bookings')
                ->join('trips', 'trips.trip_id', '=', 'bookings.trip_id')
                ->select('bookings.*', 'trips.*')
                ->orderBy('bookings.booking_id', 'desc')
                ->get();
        //dd($bookings);
        if($user_role == 0 || $user_role == 1 || $user_role == 2)
        {
        return view('admin.bookings.index', compact('user', 'drivers', 'locations', 'buses', 'bookings', 'user_role'));
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }

    }





    public function edit_admin_booking($id)
    {
        //
        $user = Auth::user();
        $drivers = Driver::all();
        $locations = Location::all();
        $buses = Bus::all();
        $trips = Trip::all();
        $user_role = Auth::user()->role_id;
        $booking = Booking::join('trips', 'trips.trip_id', '=', 'bookings.trip_id')
        ->select('bookings.*', 'trips.*')
        ->findOrFail($id);

        if($user_role == 0 || $user_role == 1 || $user_role == 2)
        {
            return view('admin.bookings.edit', compact('drivers', 'trips', 'locations', 'buses', 'booking', 'user', 'user_role'));
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }

    }


    public function update_admin_booking(Request $request, $id)
    {
        //
        $user_role = Auth::user()->role_id;
        if($user_role == 0 || $user_role == 1 || $user_role == 2)
        {
            $user_role = Auth::id();
            $booking = Booking::findOrFail($id);
            $booking->booking_code=$request->booking_code;
            $booking->number_passengers=$request->number_passengers;
            $booking->number_children=$request->number_children;
            $booking->contact_person=$request->contact_person;
            $booking->booking_seat=$request->booking_seat;
            $booking->luggage_over=$request->luggage_over;
            $booking->user_id=$user_role;
            $booking->trip_id=$request->trip_id;
            $booking->booking_code=$request->booking_code;
            $booking->bus_number = $request->bus_number;
    
            $booking_fare = $request->booking_fare;

            $booking->save();
            return redirect()->back()->with('message', 'Booking updated Successfully');
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }
    }


    public function show_trip_bookings(Request $request, $trip_id)
    {
        $user = Auth::user();
        $user_role = Auth::user()->role_id;

        $trip = Trip::findOrFail($trip_id);
        $users = User::all();

        $this->session_trip = $trip_id;

        $bookings = Booking::where('trip_id', '=', $this->session_trip)
        ->orderBy('booking_id', 'desc')
        ->get();



        if($user_role == 0 || $user_role == 1 || $user_role == 2)
        {
        return view('admin.bookings.index',compact('bookings', 'trip', 'user', 'users', 'user_role'));
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }
    }



    public function create_trip_booking($id)
    {
        //
        $user_role = Auth::user()->role_id;
        if($user_role == 0 || $user_role == 1 || $user_role == 2)
        {
            $user = Auth::user();
            $users = User::all();
            $locations = Location::all();
            $trip = Trip::findOrFail($id);


            return view('admin.bookings.create_trip_booking', compact('user', 'users', 'trip', 'locations', 'user_role'));
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }
    }



    public function search_booking_user(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required',
        ]);

        $user = Auth::user();
        $users = User::all();
        $user_role = Auth::user()->role_id;
        $locations = Location::all();
        // $trip = Trip::findOrFail($id);
        $phone = $request->phone;

        $data = DB::table('users')->where('phone', $phone)->first();


        // $search_user = User::where('phone', 'Like', '%' .$phone. '%')
        // ->get();
       return view('admin.bookings.search_booking_user', compact('data', 'user', 'users', 'locations', 'user_role'));

    }


    public function parcel_user_search(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required',
        ]);

        $user = Auth::user();
        $users = User::all();
        $locations = Location::all();
        $parcel_types = ParcelType::all();
        $phone = $request->phone;

        $data = User::where('phone', $phone)->first();

       return view('admin.parcels.search_parcel_user', compact('data', 'user', 'users', 'locations', 'parcel_types', 'user_role'));

    }



}
