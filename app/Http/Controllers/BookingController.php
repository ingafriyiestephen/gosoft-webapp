<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Bus;
use App\Models\Role;
use App\Models\Trip;
use App\Models\User;
use App\Models\Driver;
use App\Models\Booking;
use Twilio\Rest\Client;
use App\Models\Location;
use App\Models\Condition;
use App\Mail\BookingCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{

    public function store_booking(Request $request)
    {
        //    
        $messages = [
            'passenger_summary.required' => 'Please provide passengers details!',
            'luggage_count.required' => 'Please provide luggage count!',
            'customer_phone.required' => 'Please provide customer phone number!',
            'kin_name.required' => 'Please provide next of kin name!',
            'kin_contact.required' => 'Please provide next of kin contact!',
        ];

        
        $validator = Validator::make($request->all(), [
            'passenger_summary' => 'required',
            'luggage_count' => 'required',
            'customer_phone' => 'required',
            'kin_name' => 'required',
            'kin_contact' => 'required',
        ], $messages);


        if($validator->fails()){      
                    $message = $validator->errors()->first();
                    return redirect()->back()->with('error', $message);  
        }


        if($request->passenger_summary == '#'){
            return redirect()->back()->with('error', 'Passenger details cannot be null');  
        }


            $booking= new booking;

            $bookings = Booking::where('trip_id', '=', $request->trip_id)->get();
            //Covert the already booked seats in the database into an array called seat_arr
            $arr = '';
            foreach ($bookings as $bks){
                $arr = $arr . ',' . $bks->booking_seat;
            }
            $seat_arr = explode (",", $arr);  
            //Convert the incoming booking seats into an array called req_seat
            $req_seat = explode (",", $request->booking_seat);  
            // $req_seat = ['6', '7', '8'];
            foreach ($req_seat as $x) {
                if (in_array($x, $seat_arr)) { 
                    // echo "Seat " . $x . " is already booked. Please choose another seat"; 
                    return redirect()->back()->with('error', "Seat " . $x . " is already booked. Please choose another seat");
                }
              }
              
              
            if (Booking::exists() && Booking::where('trip_id', $request->trip_id)->exists()) {      
                $booking_number = Booking::where('trip_id', $request->trip_id)->orderBy('booking_number', 'desc')->first()->booking_number + 1;
            } else {
                $booking_number = 1;
            }


            $booking_code = $request->trip_name. '-' . $request->trip_id. '-' . $booking_number;

            $booking->number_passengers=$request->number_passengers;
            $booking->number_children=$request->number_children;
            $booking->contact_person=$request->customer_phone;
            $booking->kin_name=$request->kin_name;
            $booking->kin_contact=$request->kin_contact;
            $booking->booking_seat=$request->booking_seat;
            $booking->seat_count=$request->seat_count;
            $booking->luggage_count=$request->luggage_count;
            $booking->luggage_over=$request->luggage_over;
            $booking->pay_ref=$request->pay_ref;
            $booking->customer_name=$request->customer_name;
            $booking->customer_phone=$request->customer_phone;
            $booking->customer_email=$request->customer_email;
            $booking->user_id = Auth::id();
            $booking->trip_id=$request->trip_id;
            $booking->booking_code=$booking_code;
            $booking->bus_id = $request->bus_id;
            $booking->booking_number = $booking_number;
            $booking->booking_amount = $request->booking_amount;
            $booking->booking_date = Carbon::now()->toDateTimeString();
            $booking->passenger_summary = $request->passenger_summary;
            $booking->status = 'Confirmed';
            
    
            $booking->save();
    
    
            // Send SMS After successful booking via Hellio
            $booking_number = Booking::orderBy('booking_id', 'desc')->first()->booking_id;
            $receiverNumber = $request->customer_phone;
            $message = 'Hi ' . $request->customer_name .', your booking code for seat(s) '. $request->booking_seat . ' is ' .$booking_code. '. ' .' You are to arrive at the station atleast 40 mins before departure. Check Bookings in the app for details about your trip. Thank you for choosing SOFT.'; 


            // SEND SMS
            // $curl = curl_init();

            // curl_setopt_array($curl, [
            //     CURLOPT_URL => 'https://sms.arkesel.com/api/v2/sms/send',
            //     CURLOPT_HTTPHEADER => ['api-key: UWVVZEZRdm1LbXhEU09qSXRla2o'],
            //     CURLOPT_RETURNTRANSFER => true,
            //     CURLOPT_ENCODING => '',
            //     CURLOPT_MAXREDIRS => 10,
            //     CURLOPT_TIMEOUT => 0,
            //     CURLOPT_FOLLOWLOCATION => true,
            //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //     CURLOPT_CUSTOMREQUEST => 'POST',
            //     CURLOPT_POSTFIELDS => http_build_query([
            //         'sender' => 'SOFT',
            //         'message' => $message,
            //         'recipients' => [$request->customer_phone]
            //     ]),
            // ]);

            // curl_exec($curl);

            $booking_sms = 'Booking was successfull. A confirmation SMS has been sent to the passenger.';
            return redirect()->back()->with('message', $booking_sms);

  
            // curl_close($curl);


    }




    public function pay_booking(Request $request)
    {
        Booking::where('booking_code','=',$request->booking_code)->update([
            'pay_ref' => $request->pay_ref,
            'status' => 'Confirmed',
            'confirmed_date' => date(now())
        ]);


        $receiverNumber = $request->customer_phone;
        $message = 'Hi ' . $request->customer_name .', your payment for ' . $request->booking_code . ' has been received and your booking is now confirmed. Your payment reference is ' . $request->pay_ref . '. Thank you for choosing SOFT.'; 

        //Set Time Zone as this is very important to ensure your messages are delivered on time
        date_default_timezone_set('Africa/Accra');
        // Account details
        $username = env('HELLIO_SMS_USERNAME');
        $password = env('HELLIO_SMS_PASSWORD'); 
        $baseUrl = env('HELLIO_SMS_API_URL');
        $senderId = env('HELLIO_SMS_SENDER_ID');

        $params = [
        'username' => $username,
        'password' => $password,
        'senderId' => $senderId,
        'msisdn' => $receiverNumber,
        'message' => $message 
        ];

        // Send the POST request with cURL
        $ch = curl_init($baseUrl);
        $payload = json_encode($params);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($payload)
        ));
        // Process your response here
        curl_exec($ch);
        //echo var_export($response, true);
        return redirect('/')->with('message', 'Payment was successful. Check your phone for a confirmation SMS.');
        //return response()->json(['success'=>true,'message'=>'Payment was successful. Check your phone for a confirmation SMS.']); 
        curl_close($ch);
    }


    public function my_bookings()
    {
        $user = Auth::user();
        $user_id = Auth::id();
        $role_id = $user->role_id;
        $today = Carbon::today();
        $bookings = Booking::orderBy('booking_id', 'desc')
        ->join('trips', 'trips.trip_id', '=', 'bookings.trip_id')
        ->join('buses', 'buses.bus_id', '=', 'bookings.bus_id')
        ->join('users', 'users.id', '=', 'bookings.user_id')
        ->whereDate('bookings.created_at', $today)
        // ->where('bookings.role_id', '!=', 6)
        ->where('bookings.user_id', $user_id)
        ->select('bookings.*', 'trips.*', 'buses.*', 'users.*')
        ->get();

        return view('admin.bookings.my-bookings', compact('bookings'));
    }



    //Allow the user to select seat after booking
    public function select_seat($id)
    {
        $user_email= Auth::user()->email;
        $trip = Trip::findOrFail($id);
        return view('home.seats', compact('user_email', 'trip'));
    }


    public function update_seat(Request $request, $id)
    {
        //
        $user_role = Auth::user()->role_id;
        if($user_role == 1 || $user_role == 2 || $user_role == 3 || $user_role == 4 || $user_role == 5)
        {
            $seat = Trip::find($id);
            // Make sure you've got the Page model
            if($seat) {
                $seat->seat_3 = 'true';
                $seat->save();
    
            }
            // $user->save();
            return redirect()->back()->with('message', 'Seat confirmed Successfully');
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }

    }
    

    public function update_trip_seat(Request $request, $id)
    {
        //
        $user_role = Auth::user()->role_id;
        if($user_role == '1')
        {
            $user = User::find($id);

            // Make sure you've got the Page model
            if($user) {
                $user->role_id = $request->role_id;
                $user->save();
            }

            // $user->save();
            return redirect()->back()->with('message', 'User updated Successfully');
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }

    }


    public function confirm_booking(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        // dd($request->booking_id_confirm);
        $booking->status = 'Confirmed';  
        $booking->confirmed_date = Carbon::now()->toDateTimeString();

        $booking->save();

        return redirect()->back()->with('message', 'Booking confirmed successfully');
       
    }




    public function customers()
    {   $roles = Role::all();


        $customers = Booking::latest()->get()->unique('customer_number');

        // $customers = DB::table('bookings')
        // ->groupBy('customer_number')
        // ->selectRaw('count(number_booking) as count, customer_number')
        // ->pluck('count','customer_number');

        $user = Auth::user();
        $user_role = Auth::user()->role_id;



        if ($user_role == 0 || $user_role == 1)
        {
            return view('admin.customers.index', compact('user', 'user_role', 'roles', 'customers'));
        }else{
            return('You are not authorized to view this page. Please contact the administrator');
        }
    }



    //
    public function store_user_booking(Request $request)
    {

        $booking= new booking;
        
        $booking->booking_id=$request->booking_id;
        $booking->number_passengers=$request->number_passengers;
        $booking->number_children=$request->number_children;
        $booking->contact_person=$request->contact_person;
        $booking->booking_seat=$request->booking_seat;
        $booking->luggage_over=$request->luggage_over;
        $booking->pay_ref=$request->pay_ref;
        $booking->booking_code=$request->booking_code;
        $booking_code = $request->booking_code;
        $booking->bus_number = $request->bus_number;
        $booking_fare = $request->booking_fare;

    }

}
