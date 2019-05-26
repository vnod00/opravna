<?php

namespace App\Http\Controllers\Auth;
use App\User;
use App\Order;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
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
    protected $redirectTo = '/orders';

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
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $orders = Order::orderBy('ord_id','asc')->paginate(10);
        $GitHubUser = Socialite::driver('github')->user();
        //dd($GitHubUser);
       $user = User::firstOrCreate([      
            'email' => $GitHubUser->getEmail(),
            ],
            [
            'first_name' => $GitHubUser->getNickName(),
            'provider_id' => $GitHubUser->getId(),
            'role_id' => 3,
            
        ]);
        Auth::login($user, true);
        return redirect($this->redirectTo)->with('orders', $orders)->with('success', 'Byl jste úspěšně přihlášen!');
    }

}
