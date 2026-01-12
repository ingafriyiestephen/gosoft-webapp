<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
// use Illuminate\Validation\Validator;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //return Booking::latest()->get();
        return Booking::join('trips', 'trips.trip_id', '=', 'bookings.trip_id')
        ->select('bookings.*', 'trips.*')
        ->orderBy('bookings.booking_id', 'desc')
        ->get();
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
            'kin_name.required' => 'Next of kin details cannot be null!',
            'kin_contact.required' => 'Next of kin details cannot be null!',
            'passenger_summary.required' => 'Please provide passengers details!',
            'number_children.required' => 'Number of children below 4 years cannot be empty! At least 0 should be entered.',
            'luggage_count.required' => 'Luggage count cannot be null!  At least 0 should be entered.',
        ];

        
        $validator = Validator::make($request->all(), [
            'kin_name' => 'required',
            'kin_contact' => 'required',
            'passenger_summary' => 'required',
            'number_children' => 'required',
            'luggage_count' => 'required',
        ], $messages);
        
        
        if($request->passenger_summary == '#'){
            return response()->json(['success'=>false,'message'=>"Passenger details cannot be null"]); 
        }
        
        
        if($request->number_children > 1){
            return response()->json(['success'=>false,'message'=>"Number of children below 4 years cannot be more than 1"]); 
        }


        if($validator->fails()){      
                    $message = $validator->errors()->first();
                    return response()->json(['statusCode'=>200,'success'=>false,'message'=>$message], 200); 
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
                    return response()->json(['success'=>false,'message'=>"Seat " . $x . " is already booked. Please choose another seat"]); 
                }
              }
              
              
            //$exists = Booking::where('column_name', 'value')->exists();

              
              
            if (Booking::exists() && Booking::where('trip_id', $request->trip_id)->exists()) {      
                $booking_number = Booking::where('trip_id', $request->trip_id)->orderBy('booking_number', 'desc')->first()->booking_number + 1;
            } else {
                $booking_number = 1;
            }


            $booking_code = $request->trip_name. '-' . $request->trip_id. '-' . $booking_number;
            
            $user = User::where('id', $request->user_id)->first();
            
            // return response()->json(['message'=>$user->role_id]);

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
            $booking->user_id=$request->user_id;
            $booking->role_id= $request->role_id;
            $booking->trip_id=$request->trip_id;
            $booking->booking_code=$booking_code;
            $booking->bus_id = $request->bus_id;
            $booking->booking_number = $booking_number;
            $booking->booking_amount = $request->booking_amount;
            $booking->booking_date = Carbon::now()->toDateTimeString();
            $booking->passenger_summary = $request->passenger_summary;
            $booking->status = 'Pending';
            
    
            $booking->save();
            

    
    
            // Send SMS After successful booking
            $booking_number = Booking::orderBy('booking_id', 'desc')->first()->booking_id;
            
            $receiverNumber = $request->customer_phone;
            
            $message = 'Seat ' .   $request->booking_seat . ' booked from ' . $request->trip_departure . ' to ' . $request->trip_destination . ' for ' . $request->trip_date . '. Reporting: ' . $request->reporting_time . '. Departure:' . $request->departure_time . '. Ref: ' . $booking_code . '. Enquiries: 0241154373.';
            
            
             // SEND SMS
            $curl = curl_init();
            
            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://sms.arkesel.com/api/v2/sms/send',
                CURLOPT_HTTPHEADER => ['api-key: UWVVZEZRdm1LbXhEU09qSXRla2o'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => http_build_query([
                    'sender' => 'SOFT',
                    'message' => $message,
                    'recipients' => [$receiverNumber]
                ]),
            ]);
            
            curl_exec($curl);
            //echo var_export($response, true);
            return response()->json(['success'=>true,'booking_code'=>$booking_code,'booking_amount'=>$request->booking_amount,'message'=>'Booking was successful. Check your phone for a confirmation SMS.']); 
            curl_close($curl);

    }

    public function pay_booking(Request $request)
    {
        Booking::where('booking_code','=',$request->booking_code)->update([
            'pay_ref' => $request->pay_ref,
            'status' => 'Confirmed',
            'confirmed_date' => date(now())
        ]);


        $receiverNumber = $request->customer_phone;
        $message = 'Your Payment for ' . $request->booking_code . ' has been received and confirmed. Payment reference: ' . $request->pay_ref . '. Thank you for choosing SOFT.'; 
        
        
        // SEND SMS
        $curl = curl_init();
        
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://sms.arkesel.com/api/v2/sms/send',
            CURLOPT_HTTPHEADER => ['api-key: UWVVZEZRdm1LbXhEU09qSXRla2o'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query([
                'sender' => 'SOFT',
                'message' => $message,
                'recipients' => [$receiverNumber]
            ]),
        ]);
        
        curl_exec($curl);
        //echo var_export($response, true);
        return response()->json(['success'=>true,'message'=>'Payment was successful. Check your phone for a confirmation SMS.']); 
        curl_close($curl);

    }
    
    public function payment_callback(Request $request)
    {
        //return $request->all();
        $payment_details = $request->Data;
        $clientReference = explode("#", $payment_details['ClientReference'], 2);
        $booking_code = $clientReference[0];


        Booking::where('booking_code','=',$booking_code)->update([
            'pay_ref' => $payment_details['ClientReference'],
            'status' => 'Confirmed',
            'confirmed_date' => date(now())
        ]);
    }

    // public function pay_booking(Request $request)
    // {
    //     /**
    //      * Requires libcurl
    //      */
    //     //return response()->json(['success'=>true,'message'=>'Payment was successfull. Check your phone for a confirmation SMS.']); 

    //     $mobileNumber = "233544784957";
    //     $curl = curl_init();

    //     $payload = array(
    //     "amount" => 1,
    //     "title" => "Title",
    //     "description" => "Complete your payment for trip",
    //     "clientReference" => "Booking Code",
    //     "callbackUrl" => "http://127.0.0.1:8000/login",
    //     "cancellationUrl" => "http://127.0.0.1:8000/login",
    //     "returnUrl" => "http://127.0.0.1:8000/login",
    //     "logo" => "https://sofrimpongtransport.com/wp-content/uploads/elementor/thumbs/logo-ppp4l2i2hzm0gxj81m5v1ldoftogbn4biok9e13tv8.jpg"
    //     );

    //     curl_setopt_array($curl, [
    //     CURLOPT_HTTPHEADER => [
    //         "Content-Type: application/json",
    //         "Authorization: Basic " . base64_encode("vevcouhv:mdiledyj")
    //     ],
    //     CURLOPT_POSTFIELDS => json_encode($payload),
    //     // CURLOPT_URL => "https://devp-reqsendmoney-230622-api.hubtel.com/request-money/" . $mobileNumber,
    //     CURLOPT_URL => "https://devp-reqsendmoney-230622-api.hubtel.com/send-money/" . $mobileNumber,
    //     CURLOPT_RETURNTRANSFER => true,
    //     CURLOPT_CUSTOMREQUEST => "POST",
    //     ]);

    //     $response = curl_exec($curl);
    //     $error = curl_error($curl);

    //     curl_close($curl);

    //     if ($error) {
    //     echo "cURL Error #:" . $error;
    //     } else {
    //     echo $response;
    //     }
    // }




    


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }

    public function to_array(){
        // $bookings = Booking::all();
        // $arr = '';
        // foreach ($bookings as $bks){
        //     $arr = $arr . ',' . $bks->booking_seat;
        // }
        // $seat_arr = explode (",", $arr);  
        // $req_seat = ['6', '7', '8'];
        // foreach ($req_seat as $x) {
        //     if (in_array($x, $seat_arr)) { 
        //         echo "Seat " . $x . " is already booked. Please choose another seat"; 
        //     }else{
        //         echo"not found";
        //     }
        //   }
    }
}
