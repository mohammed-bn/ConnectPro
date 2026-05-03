<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Client;
use App\Models\Professionnel;
use App\Models\Admin;
use App\Models\Post;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required',
            'city'     => 'nullable|string|max:100',
            'region'   => 'nullable|string|max:100',
            'address'  => 'nullable|string|max:255',
        ]);

    
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'city'     => $request->city,      
            'region'   => $request->region,    
            'address'  => $request->address,   
        ]);


        if ($request->role === 'professional') {
               session(['role' => 'professional']);
            Professionnel::create([
                'user_id' => $user->id,
                'speciality_id' => 1
            ]);

            Auth::login($user);

            return redirect()->route('professionnel.dashboard');

        }else {
            session(['role' => 'client']);
            Client::create([
                'user_id' => $user->id
            ]);

            Auth::login($user);

            return redirect()->route('client.dashboard');
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials) ) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->status === 'banned') {
            Auth::logout(); 
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return back()->withErrors([
                'email' => 'Votre compte a été bloqué. Veuillez contacter l\'administrateur.',
            ]);
            }
            
            //********************************
            if ($user->professionnel) {
                return redirect()->route('professionnel.dashboard');
            }
            elseif ($user->client && $user->admin){
                return redirect()->route('admin.dashboard');
            }
            elseif($user->client){
                return redirect()->route('client.dashboard');
            }
            //********************************
            
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        return back()->with('status', 'Lien de réinitialisation envoyé à votre adresse email.');
    }

}