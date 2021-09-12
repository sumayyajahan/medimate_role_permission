<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\FileHelper;
use App\Models\ReferralHistory;
use App\Models\UserWallet;
use Illuminate\Support\Facades\Auth;
use Validator;
use Str;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $childs = User::where('parent_id', Auth::id())->get();
        $parent = User::where('id', Auth::user()->parent_id)->first();
        // if($parent){
        //     $parent = $parent->toArray();
        //     $childs = array_merge($parent, $childs);
        // }
        return response()->json(['parent' => $parent, 'childs' => $childs], 200);
        // return $this->jsonResponse($childs, "List of Child accounts.");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'nullable|email|max:191|unique:users',
            'mobile' => 'nullable|string|unique:users',
            'address' => 'required|string|max:191',
            'lat' => 'nullable',
            'lng' => 'nullable',
            'gender' => 'nullable',
            'dob' => 'nullable|date',
            'image' => 'nullable|image',
            'password' => 'required|string|min:8|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        // return Auth::user();
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        if ($request->mobile == NULL) {
            $input['mobile'] = Auth::user()->mobile;
        }
        // $input['parent_id'] = Auth::user()->id;

        // user id according to relation
        $relationship = strtolower($input['relationship']);
        $userId = "";
        if ($relationship == "pet") {
            $userId = "MMPT";
        } elseif ($relationship == "cattle") {
            $userId = "MMCT";
        } elseif ($relationship == "other") {
            $userId = "MMOT";
        } else {
            $userId = "MMPA";
        }

        $input['userid'] = $userId . date('ymdHis') . rand(10, 99);
        $user = User::create($input);

        $imageName = FileHelper::uploadImage($request, $user);
        // $user->parent_id = Auth::user()->id;
        $user->update(['image' => $imageName]);
        $user->update(['view_password' => $request->password]);


        $userData = User::findOrFail($user->id);
        // Referral Create
        // $referralCode = Str::slug($request->name) . "-" . $user->id;
        $referralCode = Str::slug($request->name) . "-" . rand(11, 999);
        $userData->referral_code = $referralCode;
        $userData->parent_id = Auth::user()->id;
        $userData->save();
        // Wallet Create
        UserWallet::create(['user_id' => $user->id]);

        if ($request->referral_code !== "") {
            $referral_code = Auth::user()->referral_code;

            $referred_by_id = User::Select('id')->where('referral_code', $referral_code)->first();

            if ($referred_by_id) {
                $rh = ReferralHistory::create(['referred_by_id' => $referred_by_id->id, 'user_id' => $user->id, 'referral_code' => $referral_code])->save();
            }
        }

        return $this->jsonResponse($userData, "Child Account Create Successful.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return $this->jsonResponse($user, "Child Account.");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'mobile' => 'required|string|unique:users',
                'email' => 'required|string|unique:users',
                'password' => 'required|string|min:8',
            ]
        );
        $user = User::findOrFail($id);
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->parent_id = NULL;
        $user->save();
        return $this->jsonResponse($user, "Accound Seperated Successful.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function childByHealthId(Request $request)
    {
        $user = User::where('userid', $request->health_id)->first();

        return $this->jsonResponse($user, "Child Account.");
    }

    public function childByPhone(Request $request)
    {
        $user = User::where('mobile', $request->health_id)->first();

        return $this->jsonResponse($user, "Child Account.");
    }
}
