<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;

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
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.guest')->except('logout');
    }
     protected function credentials(Request $request)
    {
        

        return [
            'email' => $request->email,
            'password' => $request->password, 
            'status' => 1,
            
        ];
    }
        // Function to get response of verified user message
    protected function sendFailedLoginResponse(Request $request)
    {
        $user = Admin::where('email', $request->input('email'))->first();

        if ($user && $user->status!=1) {
            $errorMessage = 'Your profile is susbended , Please contact admin.'; 
        }
       

        $errors = ['email' => $errorMessage];

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors($errors);
    }   
    public function showLoginForm()
    {
        //die('test');
        return view('admin.auth.login');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/admin');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
