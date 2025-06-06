<?php

namespace App\Http\Controllers\Admin\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = route('admin.index');
        $this->middleware('guest')->except('logout');
    }


    public function showLoginForm()
    {
        return view('pages.admin.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'       => 'required|email',
            'password'    => 'required|min:6'
        ]);

        if ($this->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect('/admin');
        } else{
            return redirect()->back()->with(['error' => 'Incorrect email or password']);
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
        ? new Response('', 204)
        : redirect('/admin');
    }

    protected function guard($guard)
    {
        return Auth::guard($guard);
    }
}
