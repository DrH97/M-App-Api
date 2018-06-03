<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    // protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     // $this->middleware('auth:api')->except('logout');
    // }

    // public function authenticate(Request $request) {
    //     $this->validateLogin($request);
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::guard('web')->attempt($credentials))
    //         return response()->json(Auth::guard('web')->user());

    //     return $this->sendFailedLoginResponse($request);
    // }

    // protected function validateLogin(Request $request)
    // {
    //     $this->validate($request, [
    //         'email' => 'required|string',
    //         'password' => 'required|string',
    //     ]);
    // }

    // protected function sendFailedLoginResponse(Request $request)
    // {
    //     throw ValidationException::withMessages([
    //         'email' => [trans('auth.failed')],
    //     ]);
    // }

}
