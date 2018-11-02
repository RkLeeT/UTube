<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\User;
use Socialite;


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

    use AuthenticatesUsers {
        logout as performLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * Get the guard to be used during authentication.
     *
     * @return string|null
     */
    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }


    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::guard($this->getGuard())->logout();
        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : 'https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://localhost.utube.com/home');
    }

    // public function logout(Request $request)
    // {
    //     // $this->performLogout($request);
    //     $this->guard()->logout();

    //         $request->session()->flush();

    //         $request->session()->regenerate();
    //     return redirect()->route('/home');
    // }


    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleProviderCallback()
        {
            try {
                $user = Socialite::driver('google')->stateless()->user();
            } catch (\Exception $e) {
                return redirect('/wrong');
            }
            // only allow people with @company.com to login
            if(explode("@", $user->email)[1] !== 'gmail.com'){
                return redirect()->to('/wrong');
            }
            // check if they're an existing user
            $existingUser = User::where('email', $user->email)->first();
            if($existingUser){
                // log them in
                auth()->login($existingUser, true);
            } else {
                // create a new user
                $newUser                  = new User;
                $newUser->name            = $user->name;
                $newUser->email           = $user->email;
                $newUser->google_id       = $user->id;
                $newUser->avatar          = $user->avatar;
                $newUser->avatar_original = $user->avatar_original;
                $newUser->save();
                auth()->login($newUser, true);
            }
            return redirect()->to('/home');
        }
}
