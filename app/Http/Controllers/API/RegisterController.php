<?php
namespace App\Http\Controllers\API;
   
use App\Models\User;
use Illuminate\Http\Request;
// use Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Mail\UserRegistered;

class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */

    public function register(Request $request): JsonResponse
    {
        // $otp = rand(100000,999999);

        $messages = [
            'name.required' => 'Please provide your full name!',
            'phone.required' => 'Please provide your phone number!',
            'confirm_phone.required' => 'Please confirm your phone number!',
            // 'email.required' => 'Please provide your email address!',
            // 'password.required' => 'Please provide your password!',
            // 'confirm_password.required' => 'Please confirm your password!',
        ];

        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|unique:users|numeric|digits:10|',
            'confirm_phone' => 'required|same:phone|unique:users|numeric|digits:10|',
            // 'email' => 'required|email|unique:users|email:rfc',
            // 'password' => 'required',
            // 'confirm_password' => 'required|same:password',
        ], $messages);


   
        if($validator->fails()){
            // return $this->sendError('Validation Error.', $validator->errors());       
                    $message = $validator->errors()->first();
                    return response()->json(['statusCode'=>200,'success'=>false,'message'=>$message], 200); 
        }


        $user = new user;
        $user->name=$request->name;
        $user->phone=$request->phone;
        $user->confirm_phone=$request->confirm_phone;
        $user->email=$request->email;
        // $user->password = Hash::make($request->password);
        // $user->confirm_password = Hash::make($request->confirm_password);
        // $user->otp=$otp;
        
        $user->save();


        $receiverNumber = '+233' . $request->phone;
        // $message = 'Your OTP number is '. $otp. '. Please do not share this with any body.'; 

        /**
         * Requires libcurl
         */

         $fields = [
            'expiry'=> 5,
            'length'=> 6,
            'medium'=> 'sms',
            'message'=> 'Your SOFT otp code is %otp_code%. DO NOT SHARE THIS CODE WITH ANYONE.',
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
            return response()->json([
                'status'=> 1,
                'success'=>true,
                'message'=>'OTP generation was successful'
            ]);

            curl_close($curl);
            //echo $response;

    }



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
                // User::where('phone','=',$request->otp_phone_number)->update(['otp' => null]);
                return response()->json([
                    'status'=> 1,
                    'data'=>$user_details,
                    'success'=>'Your OTP verification was sucessful.'
                ]);
            }else{

                return response()->json([
                    'code'=>$data['code'],
                    'status'=> 0,
                    'error'=>'You entered a wrong OTP or your OTP has expired. Please request a new OTP.'
                ]);
            }
            
            curl_close($curl);
            // echo $response;
    }



    public function get_otp(Request $request){
        $messages = [
            'phone_number.required' => 'Please provide your phone number!',
        ];

        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|numeric|digits:10',
        ], $messages);
   
        if($validator->fails()){
            // return $this->sendError('Validation Error.', $validator->errors());       
                    $message = $validator->errors()->first();
                    return response()->json(['statusCode'=>200,'success'=>false,'message'=>$message], 200); 
        }


        $user = User::where('phone', $request->phone_number)->first();
  
        if (is_null($user)) {
               return response()->json(['success'=>false,'message'=>'You cannot login in with your mobile number because you do not have an account. Please register an account below!']); 
        }else{
            $receiverNumber = '+233' . $request->phone_number;
                        /**
             * Requires libcurl
             */

             $fields = [
                'expiry'=> 5,
                'length'=> 6,
                'medium'=> 'sms',
                'message'=> 'Your SOFT otp code is %otp_code%. DO NOT SHARE THIS CODE WITH ANYONE.',
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
                return response()->json([
                    'status'=> 1,
                    'success'=>true,
                    'message'=>'OTP generation was successful'
                ]);
    
                curl_close($curl);
                //echo $response;

        }


    }


       

    public function verify_otp(Request $request){

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
                // User::where('phone','=',$request->otp_phone_number)->update(['otp' => null]);
                return response()->json([
                    'status'=> 1,
                    'data'=>$user_details,
                    'success'=>'Your OTP verification was sucessful.'
                ]);
            }else{

                return response()->json([
                    'code'=>$data['code'],
                    'status'=> 0,
                    'error'=>'You entered a wrong OTP or your OTP has expired. Please request a new OTP.'
                ]);
            }
            
            curl_close($curl);
            // echo $response;
    }

}