<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\Registered;


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

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    // protected function attemptLogin(Request $request)
    // {
    //     // return Auth::attempt($this->credentials($request));
    //     // return $this->guard()->attempt(
    //     //     $this->credentials($request), $request->filled('remember')
    //     // );
    //     return Auth::guard('web')->attempt(
    //         $this->credentials($request), $request->filled('remember')
    //     );
    // }

    // /**
    //  * Send the response after the user was authenticated.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // protected function sendLoginResponse(Request $request)
    // {
    //     // $request->session()->regenerate();

    //     $this->clearLoginAttempts($request);

    //     return $this->authenticated($request, $this->guard()->user())
    //             // ?: "Yes";
    //             ?: response()->json(Auth::guard('web')->user());
    //             // ?: redirect()->intended($this->redirectPath());
    // }

    // /**
    //  * Log the user out of the application.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function logout(Request $request)
    // {
    //     // $this->guard()->logout();
    //     Auth::guard('web')->logout();

    //     // $request->session()->invalidate();

    //     return response()->json("Successful Logout");
    //     // return redirect('/');
    // }


     /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $validator = $this->validateLogin($request);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        
        if ($this->authenticate($request)){
            $response = [
                'status' => 'success',
                'message' => 'successful authentication',
                'user' => Auth::user(),
            ];
        } else {
            $response = [
                'status' => 'fail',
                'message' => 'Invalid credentials',
            ];
        }
        
        return response()->json($response);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        return Validator::make($request->all(), [
            $this->username() => 'required|string|email',
            'password' => 'required|string',
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return true;
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {        
        Auth::logout();

        $response = [
            'status' => 'success',
            'message' => 'successful Logging out',
            'user' => Auth::user(),
        ];

        return response() ->json($response);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());
        // ->validate()
        // return 'true';
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        
        event(new Registered($user = $this->create($request->all())));        
        
        if ($user){
            $response = [
                'status' => 'success',
                'message' => 'successful registration',
                'user' => $user,
            ];
        } else {
            $response = [
                'status' => 'fail',
                'message' => 'An error occured, please try again',
            ];
        }
        
        return response()->json($response);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

     /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return \App\User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

}
