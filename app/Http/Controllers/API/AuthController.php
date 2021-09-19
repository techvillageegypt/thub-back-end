<?php

namespace App\Http\Controllers\API;

use Auth;
use App\Models\User;
use App\Models\Driver;
use Illuminate\Http\Request;
use App\Mail\RegistrationMail;
use App\Helpers\HelperFunctionTrait;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Helpers\SmsTrait;

class AuthController extends Controller
{
    use HelperFunctionTrait, AuthenticatesUsers, SmsTrait;

    // Start user

    public function login_or_register_user(Request $request)
    {
        $phone = $request->validate(['phone' => 'required|numeric']);
        $driver = User::where($phone)->where('type', 'driver')->first();

        if ($driver) {
            return response()->json(['msg' => 'Use Your verification To Complete Login Process']);
        } else {
            $user = User::where($phone)->firstOr(function () {
                $customer = Customer::create();
                return User::create([
                    'phone'             => request('phone'),
                    'userable_id'       => $customer->id,
                    'userable_type'     => "App\Models\Customer",
                    'type'              => "customer",
                ]);
            });
            $user->update(['verify_code' => $this->randomCode(4)]);
        }

        // Send OTP To User.
        $phone  = $user->phone;
        $msg     = " $user->verify_code is your verification code.
        {*code*}";

        $this->sendOtp($phone, $msg, env('APP_NAME'));
        // End Send OTP To User.

        return response()->json(['msg' => 'A confirmation code has been sent, check your inbox', 'code' => $user->verify_code]);
    }


    public function verify_code_user(Request $request)
    {
        $inputs = $request->validate(['phone' => 'required|numeric', 'verify_code' => 'required|min:4|max:5']);

        $data['user'] = User::firstWhere($inputs);

        if (empty($data['user'])) {
            return response()->json(['msg' => 'Verify code is not correct'], 403);
        }

        $data['user']->load('userable.state');
        $data['token'] = auth('api')->tokenById($data['user']->id);

        return response()->json($data);
    }


    public function updateDeviceId()
    {
        $data['user'] = auth('api')->user();
        $data['user']->update(['device_id' => request('device_id')]);

        return response()->json($data);
    }

    // End user


    public function logout()
    {
        auth('api')->logout();

        return response()->json(['msg' => 'success']);
    }
}
