<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Role;
use App\Models\Trip;
use App\Models\User;
use App\Models\Driver;
use App\Models\Booking;
use App\Models\Session;
use App\Models\Location;
use App\Models\Condition;
use App\Mail\LocationAdded;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public $session_user;
    public $new_member;





    public function verify_register_otp(Request $request){
        /**
         * Requires libcurl
         */

         $fields = [
            'api_key'=> 'UWVVZEZRdm1LbXhEU09qSXRla2o',
            'code'=> $request->otp,
            'number'=>$request->otp_phone_number,
            ];
            $postvars = '';
            foreach($fields as $key=>$value) {
                $postvars .= $key . "=" . $value . "&";
            }
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sms.arkesel.com/api/otp/verify',
            CURLOPT_HTTPHEADER => array('api-key: UWVVZEZRdm1LbXhEU09qSXRla2o'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $postvars,
            ));

            $response = curl_exec($curl);

            $data = json_decode($response, true);
            if($data['message'] == 'Successful'){
                $user_details = User::where('phone','=',$request->otp_phone_number)->get();
                $user  = User::where('phone','=',$request->otp_phone_number)->first();
                $user->phone_verified = 1;
                // $user->otp = $request->requestId;
                User::where('phone','=',$request->otp_phone_number)->update(['otp'=>$request->otp]);
                Auth::login($user, true);
                return redirect('/');

            }else{

                $otp_phone_number = $request->otp_phone_number;
                $otp_message = 'You entered a wrong OTP or your OTP has expired. Please try again or request a new OTP.';
                return view('auth.verify-otp', compact('otp_phone_number', 'otp_message'));
            }
            
            curl_close($curl);
            // echo $response;
    }


    public function get_otp(Request $request){
        $validatedData = $request->validate([
            'phone_number' => 'required|min:10|max:10',
        ]);


        $user = User::where('phone', $request->phone_number)->first();
        

        if (is_null($user) || $user->role_id == 6 ) {
               return redirect()->back()->with('error', 'Your mobile number may be incorrect or invalid.  Please contact the administrator if you are authorized to access this page.');   
        }else{
            $receiverNumber = '+233' . $request->phone_number;
                        /**
             * Requires libcurl
             */

             $fields = [
                'expiry'=> 5,
                'length'=> 6,
                'medium'=> 'sms',
                'message'=> 'Enter the code: %otp_code% to login to the app. DO NOT SHARE THIS CODE WITH ANYONE.',
                'number'=> $receiverNumber,
                'sender_id'=>'SOFT',
                'type'=>'numeric',
                ];
                $postvars = '';
                foreach($fields as $key=>$value) {
                    $postvars .= $key . "=" . $value . "&";
                }
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://sms.arkesel.com/api/otp/generate',
                CURLOPT_HTTPHEADER => array('api-key: UWVVZEZRdm1LbXhEU09qSXRla2o'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $postvars,
                ));
    
                curl_exec($curl);

                $otp_phone_number = $request->phone_number;
                $otp_message = 'A verification code was sent to ' . $otp_phone_number . '. Please enter the code below.';
                return view('auth.verify-otp', compact('otp_phone_number', 'otp_message'));
    
                curl_close($curl);
                //echo $response;

        }


    }




    public function team_members()
    {   
        $user = Auth::user();
        $roles = Role::all();
        $locations = Location::all()
        ->sortBy('location_name');

        $user_role = Auth::user()->role_id;


        $users = User::join('roles', 'roles.role_id', '=', 'users.role_id')
        ->orWhere('roles.role_id', 0)
        ->orWhere('roles.role_id', 1)
        ->orWhere('roles.role_id', 2)
        ->orWhere('roles.role_id', 3)
        ->get();


        if ($user_role == 0 || $user_role == 1)
        {
            return view('admin.teams.index', compact('user', 'users', 'roles', 'locations', 'user_role'));
        }else{
            return('You are not authorized to view this page. Please contact the administrator');
        }
    }



    //
    public function store_member(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|unique:users|min:10|max:10',
            'email' => 'email:rfc,dns|required|unique:users',
            'role_id' => 'required',
            'password' => 'required|max:20',
        ]);


        $user = new User;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->password = Hash::make($request->password);

        $this->new_member = $request->name;

        $user->save();

        
        return redirect()->back()->with('message', 'Team Member added Successfully');
    }



    public function edit_member($id)
    {
        //
        $roles = Role::all();
        $locations = Location::all()
        ->sortBy('location_name');
        $user_role = Auth::user()->role_id;
        if ($user_role == 0 || $user_role == 1)
        {
            $user = User::join('roles', 'roles.role_id', '=', 'users.role_id')
            ->select('users.*', 'roles.*')
            ->findOrFail($id);
            return view('admin.teams.edit', compact('user', 'user_role', 'roles', 'locations'));
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }

    }



    public function update_member(Request $request, $id)
    {
        //
        $user_role = Auth::user()->role_id;
        if ($user_role == 0 || $user_role == 1)
        {
            $user = User::find($id);

            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'phone' => 'required|min:10|max:10',
                'email' => 'email:rfc,dns|required',
                // 'role_id' => 'required|max:255',
                // 'location' => 'required|max:255',
                // 'address' => 'required|max:255',
                // 'id_type' => 'required|max:20',
                // 'id_number' => 'required',
            ]);
    

            // Make sure you've got the Page model
            if($user) {
                $user->name = $request->name;
                $user->phone = $request->phone;
                $user->email = $request->email;
                $user->role_id = $request->role_id;
                // $user->password = Hash::make($request->password);
                // $user->password = Hash::make($request->password);
                $user->save();
            }

            // $user->save();
            return redirect()->back()->with('message', 'Team Member updated Successfully');
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }

    }



    public function delete_member($id){
        //
        $user_role = Auth::user()->role_id;
        if ($user_role == 0 || $user_role == 1)
        {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->back()->with('message', 'Team Member deleted Successfully');
        }
        else{
            return('You are not authorized to view this page. Please contact the administrator');
        }
    }

}
