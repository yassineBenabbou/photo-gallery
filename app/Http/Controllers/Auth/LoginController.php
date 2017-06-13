<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\User;
use Auth;
use Socialite;
use Session;
use Storage;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();        
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        $this->redirectTo = session('backURL') ? session('backURL') : '/';
        session(['backURL' => '/']);
        return redirect($this->redirectTo);
        // $user->token;
    }

    public function findOrCreateUser($user, $provider)
    {
        $directory = User::$avatarFolder;
        
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            $avatar = \Image::make(file_get_contents($user->getAvatar()))->fit(70, null, null, 'top')->encode('jpg');
            Storage::put($directory.'/'.$authUser->avatar, $avatar->__toString());            
            return $authUser;
        }

        $filename = time().md5($user->id).'.jpg';
        

        $avatar = \Image::make(file_get_contents($user->getAvatar()))->fit(70, null, null, 'top')->encode('jpg');
        Storage::put($directory.'/'.$filename, $avatar->__toString());

        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id,
            'avatar' => $filename
        ]);
    }    

}
