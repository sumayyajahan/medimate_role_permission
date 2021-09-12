<?php

namespace App\Http\Controllers\Api\Salesman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PharmacySalesman;
use Illuminate\Support\Facades\Auth;
use Validator;
use Str;

class AuthController extends Controller
{
    public $successStatus = 200;

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $email = $request->input('email');
        $password = $request->input('password');

        if (PharmacySalesman::where('email', $email)->count() <= 0) return response(array("message" => "Email does not exist"), 400);

        $pharmacySalesman = PharmacySalesman::where('email', $email)->first();

        if (password_verify($password, $pharmacySalesman->password)) {
            return response(array("message" => "Sign In Successful", "data" => [
                "user" => $pharmacySalesman,

                // Below the customer key passed as the second parameter sets the role
                // anyone with the auth token would have only customer access rights
                "token" => $pharmacySalesman->createToken('Personal Access Token', ['doctor'])->accessToken
            ]), 200);
        } else {
            return response(array("message" => "Wrong Credentials."), 400);
        }
    }



    // public function login(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|string',
    //         'password' => 'required|string',
    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()], 401);
    //     }
    //     if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
    //         $pharmacySalesman = Auth::user();
    //         $success['token'] =  $pharmacySalesman->createToken('MyApp')->accessToken;
    //         return response()->json(['success' => $success], $this->successStatus);
    //     } else {
    //         return response()->json(['error' => 'Unauthorised'], 401);
    //     }
    // }
    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191|unique:pharmacy_salesmen',
            'mobile' => 'required|string|max:191',
            'password' => 'required|string|min:8|confirmed',
        ],[
            'email.unique' => 'An account with the email address you have entered is already registered. Please enter another email address.'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $pharmacySalesman = PharmacySalesman::create($input);

        $success['token'] =  $pharmacySalesman->createToken('MyApp')->accessToken;
        $success['name'] =  $pharmacySalesman->name;
        $success['email'] =  $pharmacySalesman->email;
        return response()->json(['success' => $success], $this->successStatus);
    }
    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function details()
    {
        $pharmacySalesman = Auth::user();
        return response()->json(['success' => $pharmacySalesman], $this->successStatus);
    }
}
