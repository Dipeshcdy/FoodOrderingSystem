<?php

namespace App\Http\Controllers\Socialite;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\LoginController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite as Socialite;
// use Socialite;

class GoogleController extends Controller
{
    private $login;
    public function __construct(LoginController $login)
    {
        $this->login=$login;
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()

    {

        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
            if ($finduser) {

                $this->generateAccessToken($finduser);
                Auth::login($finduser);
                $redirect=$this->redirect();
                return $redirect;
            } else {
                // dd($user);
                $userEmail = User::where('email', $user->email)->first();
                if($userEmail)
                {
                    $userEmail->google_id=$user->id;
                    $userEmail->save();
                    $this->generateAccessToken($userEmail);
                    
                    Auth::login($userEmail);
                    
                    
                }
                else{
                    
                    $newUser = User::create([
                        'username' => $user->name,
                        'email' => $user->email,
                        'google_id' => $user->id,
                        'password' => Hash::make($user->name),
                        'role_id'=>3,
                        'is_vendor'=>0,
                    ]);
                    $this->generateAccessToken($newUser);
                    
                    Auth::login($newUser);
                    
                    
                }
                $redirect=$this->redirect();
                return $redirect;
            }
        } catch (\Throwable $e) {

            Log::error($e->getMessage());
        }
    }

    private function generateAccessToken($user)
    {
        $success['token']=$user->createToken($user->username.$user->id)->accessToken;
        $success['name']=$user->username;
        Session::put('token',$success['token']);
        Session::put('user',$success['name']);
    }

    public function redirect()
    {
        // dd('hello');
        $url=session()->get('url.intended');
        // dd($url);
        //dd(auth()->user()->role->role);
        if(!empty($url) && strpos(config('app.url'), $url) === false)
                {

                    return redirect($url);
                }
                else if(auth()->user()->role->role=='admin')
                {
        // dd(auth()->user()->role->role);
                    
                    return redirect()->route('dashboard');
                }
                else if(auth()->user()->role->role=='vendor')
                {
                    return redirect()->route('vendor.dashboard');
                        
                }
                else
                {
                        
                    return redirect()->route('main');
                }
    }
    
}