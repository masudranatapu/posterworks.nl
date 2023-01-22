<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    protected $redirectTo;

    protected function redirectTo() {

        if(auth()->user()->role_id == 1 ) {

            Toastr::success('Welcome to Admin Panel :-)','Success');
            return route('admin.dashboard');

        }elseif(auth()->user()->role_id == 2 ) {

            Toastr::success('Welcome to your profile :-)','Success');
            return route('user.dashboard');

        }else {
            $this->redirectTo = route('login');
        }

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function reviewLogin(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);


        if($validation->passes()){

            $user = User::where('email', $request->email)->where('role_id', 2)->first();

            if($user) {

                if(Hash::check($request->password, $user->password)) {

                    Auth::login($user);
                    $result = 3;
                    return response()->json(['success' => 'You are successfully login.', 'result' => $result]);

                }else {
                    $result = 2;
                    return response()->json(['success' => 'Password not match. Please try again', 'result' => $result]);

                }

            }else {

                $result = 1;
                return response()->json(['success' => 'User not found', 'result' => $result]);

            }

        }else {

            $result = 0;
            return response()->json(['errors' => $validation->errors()->all(), 'result' => $result]);

        }

    }
}
