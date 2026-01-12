<?php
namespace App\Http\Controllers;
use Exception;
use App\Models\Bus;
use App\Models\Trip;
use App\Models\User;
use App\Models\Driver;
use App\Models\Parcel;
use Twilio\Rest\Client;
use App\Models\Location;
use App\Models\ParcelType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notification;
use Illuminate\Validation\ValidationException;
use NotificationChannels\Hellio\HellioChannel;
use NotificationChannels\Hellio\HellioMessage;
use Intervention\Image\ImageManagerStatic as Image;

class ParcelController extends Controller
{
    public $recepient_phone;
    public $recepient_name;
    public $recepient_message;

    public function parcel_dashboard(){
        // 
        $user = Auth::user();
        $users = User::count();
        $customers = User::where('role_id', '5')->count();
        $data = User::all();
        $locations = Location::count();
        $drivers = Driver::count();
        $buses = Bus::count();
        $trips = Trip::count();
        $parcels = Parcel::count();
        $delivery_fee = Parcel::sum('delivery_fee');
        $parcel_fee = Parcel::sum('parcel_fee');
        $total_fee = Parcel::sum('parcel_fee') + Parcel::sum('delivery_fee'); 
        $station_pickup = Parcel::where('collection_type', 'Station Pick-up')->count();
        $company_delivery = Parcel::where('collection_type', 'Company Delivery')->count();
        //Payment Status
        $count_paid = Parcel::where('payment_status', 'Paid')->count();
        $count_unpaid = Parcel::where('payment_status', 'Not-Paid')->count();

        $count_delivery = DB::table('parcels')
                ->groupBy('delivery_status')
                ->selectRaw('count(delivery_status) as count, delivery_status')
                ->pluck('count','delivery_status');

        $sum_payment = DB::table('parcels')
                ->groupBy('payment_status')
                ->selectRaw('sum(delivery_fee) as sum, payment_status')
                ->pluck('sum','payment_status');

        //Delivery Status
        $count_received = Parcel::where('delivery_status', 'Received by Company')->count();
        $count_setoff = Parcel::where('delivery_status', 'Parcel Vehicle has set off')->count();
        $count_intransit = Parcel::where('delivery_status', 'Parcel in transit to Receiver')->count();
        $count_arrived = Parcel::where('delivery_status', 'Parcel has arrived')->count();
        $count_delivered = Parcel::where('delivery_status', 'Delivered to Receiver')->count();
    
        $user_role = Auth::user()->role_id;
        if ($user_role == 0 || $user_role == 1)
        {
            return view('admin.parcels.parcel_dashboard', compact('locations', 'user', 'users', 'customers', 'data', 'drivers', 'buses', 'parcels', 'delivery_fee', 
            'parcel_fee', 'total_fee', 'station_pickup', 'company_delivery', 'count_paid', 
            'count_unpaid', 'count_received', 'count_setoff', 'count_intransit', 'count_arrived', 'count_delivered', 'sum_payment', 'count_delivery', 'user_role'));
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }
    
        }
    //
    function parcels(){

    //
    $user = Auth::user();
    $user_role = Auth::user()->role_id;
    if($user_role == 0 || $user_role == 1 || $user_role == 3 || $user_role == 4)
    {
        // $parcels = Parcel::orderBy('parcel_id', 'desc')
        // ->get();
        $parcels = Parcel::orderBy('parcel_id', 'desc')->get();
        return view('admin.parcels.index', compact('parcels', 'user', 'user_role'));
    }
    else{
        return('You are not authorized to view this page. Please contact the administrator');
    }

    }


    public function create_parcel()
    {
        $user = Auth::user();
        $users = User::all();
        $trips = Trip::all();

        $from_location = Parcel::all()->pluck('from_location');
        $to_location = Parcel::all()->pluck('to_location');
        $pickup_location = Parcel::all()->pluck('pickup_location');
        $sender_location = Parcel::all()->pluck('sender_location');
        $locations = $from_location->merge($to_location)
        ->merge($pickup_location)
        ->merge($sender_location)
        ->sort()
        ->unique();

        $buses = Parcel::all()->pluck('bus_number')->unique();

        $parcel_types = ParcelType::all()->pluck('parcel_type')->sort();

        $user_role = Auth::user()->role_id;
        if($user_role == 0 || $user_role == 1 || $user_role == 2 || $user_role == 3)
        {
            return view('admin.parcels.create_parcel', compact('user', 'users', 'locations', 'parcel_types', 'buses', 'trips', 'user_role'));
        }
        else{
            return('You are not authorized to add a parcel. Please contact the administrator');
        }

    }


    public function store_parcel(Request $request)
    {

        $parcel = new Parcel;


        $validatedData = $request->validate([
            'receiver_name' => 'required|max:255',
            'receiver_phone' => 'required|min:10|max:10',
            // 'sender_name' => 'max:255',
            //'sender_phone' => 'min:10|max:10',
            'from_location' => 'required',
            'to_location' => 'required',
            'parcel_type' => 'required',
            // 'number_parcels' => 'required',
            'collection_type' => 'required',
            'payment_status' => 'required',
            'delivery_status' => 'required',
        ]);


        if (Parcel::exists() && Parcel::where('trip_name', $request->trip_name)->exists()) {      
            $parcel_number = Parcel::where('trip_name', $request->trip_name)->orderBy('parcel_number', 'desc')->first()->parcel_number + 1;
        } else {
            $parcel_number = 1;
        }


        $parcel->receiver_name = $request->receiver_name;
        $parcel->receiver_phone = $request->receiver_phone;
        $parcel->sender_name = $request->sender_name;
        $parcel->sender_phone = $request->sender_phone;
        $parcel->sender_id_type = $request->sender_id_type;
        $parcel->sender_id_no = $request->sender_id_no;
        $parcel->sender_location = $request->sender_location;
        $parcel->sender_address = $request->sender_address;
        $parcel->from_location = $request->from_location;
        $parcel->to_location = $request->to_location;
        $parcel->parcel_type = json_encode($request->parcel_type);
        $parcel->number_parcels = $request->number_parcels;
        $parcel->parcel_weight = $request->parcel_weight;
        $parcel->collection_type = $request->collection_type;
        $parcel->pickup_location = $request->pickup_location;
        $parcel->landmark = $request->landmark;
        $parcel->delivery_fee = $request->delivery_fee;
        $parcel->parcel_fee = $request->parcel_fee;
        $parcel->payment_status = $request->payment_status;
        $parcel->parcel_number = $parcel_number;
        $parcel->delivery_status = $request->delivery_status;
        $parcel->trip_name = $request->trip_name;
        $parcel->tracking_code = $request->tracking_code;
        $parcel->staff_id = Auth::user()->id;
        $parcel->staff_name = Auth::user()->name;
        $parcel->staff_phone = Auth::user()->phone;
        $parcel->staff_email = Auth::user()->email;

        $image=$request->parcel_image;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->parcel_image->move('parcel', $imagename);
        $parcel->parcel_image=$imagename;

    
        $initID = 'PC';
        $tracking_code = $initID. '-'. $request->trip_name. '-'.   $parcel->staff_id. '-' .$parcel_number;
        $parcel->tracking_code = $tracking_code;

        $parcel->save();
        // Send SMS After successful booking via Twillio
        $receiverNumber = '233'. '' .ltrim($request->receiver_phone, '0');
        $message = 'Hi'. ' ' .$request->receiver_name.', your parcel tracking number is'. ' ' .$tracking_code. '. ' .'Find your receipt in the link below.'. ' ' .url('/parcel_receipt/'. '' .$parcel_number); 

        return redirect('/create_parcel')->with('message', 'Parcel created Successfully. An SMS has been sent to the recepient.');
    }



    public function edit_parcel($id)
    {
        $user = Auth::user();
        $user_role = Auth::user()->role_id;
        if($user_role == 0 || $user_role == 1 || $user_role == 2 || $user_role == 3)
        {
            $parcel = Parcel::findOrFail($id);

            $parcel_arr = $parcel->parcel_type;

            $from_location = Parcel::all()->pluck('from_location');
            $to_location = Parcel::all()->pluck('to_location');
            $pickup_location = Parcel::all()->pluck('pickup_location');
            $sender_location = Parcel::all()->pluck('sender_location');
            $locations = $from_location->merge($to_location)
            ->merge($pickup_location)
            ->merge($sender_location)
            ->sort()
            ->unique();

            $parcel_types = Parcel::all()->pluck('parcel_type')->sort();

            $buses = Parcel::all()->pluck('bus_number')->unique();
            return view('admin.parcels.edit_parcel', compact('user', 'parcel', 'parcel_arr', 'locations', 'buses', 'parcel_types', 'user_role'));
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }

    }



    public function update_parcel(Request $request, $id)
    {
        $validatedData = $request->validate([
            'receiver_name' => 'required|max:255',
            'receiver_phone' => 'required|min:10|max:10',
            'sender_name' => 'max:255',
            'sender_phone' => 'min:10|max:10',
            'from_location' => 'required',
            'to_location' => 'required',
            'number_parcels' => 'required',
            'collection_type' => 'required',
            'payment_status' => 'required',
            'delivery_status' => 'required',
        ]);

        $parcel = Parcel::find($id);
        $parcel->receiver_name = $request->receiver_name;
        $parcel->receiver_phone = $request->receiver_phone;
        $parcel->sender_name = $request->sender_name;
        $parcel->sender_phone = $request->sender_phone;
        $parcel->sender_id_type = $request->sender_id_type;
        $parcel->sender_id_no = $request->sender_id_no;
        $parcel->sender_location = $request->sender_location;
        $parcel->sender_address = $request->sender_address;
        $parcel->from_location = $request->from_location;
        $parcel->to_location = $request->to_location;

        
        if ($request->parcel_type == "") {
            $parcel->parcel_type = $parcel->parcel_type;
          } else {
            $parcel->parcel_type = json_encode($request->parcel_type);
          }
        

        $parcel->number_parcels = $request->number_parcels;
        $parcel->parcel_weight = $request->parcel_weight;
        $parcel->collection_type = $request->collection_type;
        $parcel->pickup_location = $request->pickup_location;
        $parcel->landmark = $request->landmark;
        $parcel->delivery_fee = $request->delivery_fee;
        $parcel->parcel_fee = $request->parcel_fee;
        $parcel->payment_status = $request->payment_status;
        $parcel->bus_number = $request->bus_number;
        $parcel->delivery_status = $request->delivery_status;
        //$parcel->user_id = $request->user_id;
        $parcel->tracking_code = $parcel->tracking_code;
        $parcel->staff_id = Auth::user()->id;
        $parcel->staff_name = Auth::user()->name;
        $parcel->staff_phone = Auth::user()->phone;
        $parcel->staff_email = Auth::user()->email;

        $image = $request->parcel_image;

        if ($image)

        {
            // $imagename = time().'.'.$image->getClientOriginalExtension();
            // $request->parcel_image->move('parcel', $imagename);
            // $parcel->parcel_image=$imagename;
            $imagename = time().'.'.$image->getClientOriginalExtension();    
            $destinationPath = public_path('/parcel');
            $imgFile = Image::make($image->getRealPath());
            $imgFile->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$imagename);
            // $destinationPath = public_path('/driver');
            // $image->move($destinationPath, $imagename);
            $parcel->parcel_image=$imagename;
        }

        //Update the related parcel
        $parcel->save();

        // Set various sms type based on the delivery status
        $receiverNumber = '233'. '' .ltrim($request->receiver_phone, '0');
        $senderNumber = '233'. '' .ltrim($request->phone, '0');
        $message_setoff = 'Hi'. ' ' .$request->receiver_name.', your parcel with tracking number'. ' ' .$parcel->tracking_code. ' ' .'has set off. Our staff would contact you when they arrive.'; 
        $message_arrive = 'Hi'. ' ' .$request->receiver_name.', your parcel'. ' ' .$parcel->tracking_code. ' ' .'has arrived successfully. Our staff would contact you shortly. Thank You for using our services.'; 
        $message_transit = 'Hi'. ' ' .$request->receiver_name.', your parcel'. ' ' .$parcel->tracking_code. ' ' .'is on a transit to your doorstep. Stay tuned'; 
        $message_delivered =  'Hi'. ' ' .$request->name.', the parcel with tracking number'. ' ' .$parcel->tracking_code. ' ' .'you sent has been delivered successfully. Thank You for using our services'; 

        //create a default empty sms. The content will be set later on
        $message = '';

        //Set Time Zone as this is very important to ensure your messages are delivered on time
        date_default_timezone_set('Africa/Accra');
        // Account details
        $username = 'CALDRIVADELIVERY';
        $password = 'CALDRIVA4110';
        // Prepare data for POST request
        $baseUrl = 'https://api.helliomessaging.com/v1/sms';
        $senderId = 'CALDRIVA'; //Change this to your sender ID e.g. HellioSMS

        //Get the delivery status and craft the message to be sent accordingly
        if ($request->delivery_status == 'Parcel Vehicle has set off'){
            $message =  $message_setoff;
        }elseif ($request->delivery_status == 'Parcel has arrived'){
            $message =   $message_arrive;
        }elseif ($request->delivery_status == 'Parcel in transit to Receiver'){
            $message =  $message_transit;
        }elseif ($request->delivery_status == 'Delivered to Receiver'){
            $receiverNumber = $senderNumber;
            $message =  $message_delivered;
        }else {
            return redirect()->back()->with('message', 'Parcel updated Successfully');  
        }


        //Preapre parameters for post
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
        $result = curl_exec($ch);
        echo var_export($result, true);
        curl_close($ch);


        //Redirect the user upon successfully saving and sending the appropriate messages
        return redirect()->back()->with('message', 'Parcel updated Successfully');
    }

    //Sign Parcel
    public function sign_parcel($id)
    {
        $parcel = Parcel::findOrFail($id);
        return view("sign.edit", compact('parcel'));
    }
    public function sign_store(Request $request, $id)
    {
        $folderPath = public_path('signature/');
        $image_parts = explode(";base64,", $request->signed);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $uniq_id = uniqid();
        $file = $folderPath . $uniq_id . '.'.$image_type;
        file_put_contents($file, $image_base64);

        $receiver_signature = $uniq_id . '.'.$image_type;

        $delivery_staff = Auth::user()->name;

        $parcel = Parcel::find($id);

        // Update parcel info
        if($parcel) {
            $parcel->receiver_signature = $receiver_signature;
            $parcel->delivery_staff = $delivery_staff;
            $parcel->save();
        }

        return back()->with('Success!', 'Thank you for signing.');
    }


    public function delete_parcel($id)
    {
        $user_role = Auth::user()->role_id;
        if($user_role == 0 || $user_role == 1 || $user_role == 2 || $user_role == 3)
        {
            $parcel = Parcel::findOrFail($id);
            $parcel->delete();
            return redirect()->back()->with('message', 'Parcel deleted Successfully');
        }
        else{
            return('You are not authorized to delete a parcel. Please contact the administrator');
        }

    }


    // public function parcel_user_search(Request $request)
    // {
    //     $this->validate($request, [
    //         'phone' => 'required',
    //     ]);

    //     $users = User::all();
    //     $locations = Location::all();
    //     $parcel_types = ParcelType::all();
    //     $phone = $request->phone;

    //     $data = User::where('phone', $phone)->first();

    //    return view('admin.parcels.search_parcel_user', compact('data', 'users', 'locations', 'parcel_types'));

    // }


        //
    function parcel_types(){
        $user = Auth::user();
        $user_role = Auth::user()->role_id;
        
        if($user_role == 0 || $user_role == 1 || $user_role == 2 || $user_role == 3)
        {
            $parcel_types = ParcelType::all();
            return view('admin.parcel_types.index', compact('parcel_types', 'user', 'user_role'));
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }
    }


    public function store_parcel_type(Request $request)
    {
        $user_role = Auth::user()->role_id;

        $validatedData = $request->validate([
            'parcel_type' => 'required|unique:parcel_types|max:255',
        ]);


        if($user_role == 0 || $user_role == 1 || $user_role == 2 || $user_role == 3)
        {
            ParcelType::create($validatedData);

            return redirect()->back()->with('message', 'Parcel Type Added Successfully');
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }
    }

    public function delete_ptype($id)
    {
        //
        $user_role = Auth::user()->role_id;
        if($user_role == 0 || $user_role == 1 || $user_role == 2 || $user_role == 3)
        {
            $parcel_type = ParcelType::findOrFail($id);
            $parcel_type->delete();
            return redirect()->back()->with('message', 'Parcel Type deleted Successfully');
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }

    }

    public function code()
    {
        $parcel_number=  Parcel::orderBy('parcel_id', 'desc')->first()->parcel_id + 1;
        $initID = 'PARC';
        $user_number = Auth::user()->id;
        $tracking_code = $initID.  $user_number. '000' .$parcel_number;
        dd($tracking_code);

    }
}
