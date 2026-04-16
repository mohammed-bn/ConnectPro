<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Client;
use App\Models\Professionnel;

class AuthController extends Controller
{

    //client
    public function dashClient()
    {
        return view('dashboard.user');
    }

    //professionnel
    public function dashProfessionell()
    {
        return view('dashboard.professionnel');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required',
        ]);

    
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);


        if ($request->role === 'professional') {

            Professionnel::create([
                'user_id' => $user->id,
                'category',
                'spesialitie_id' => 1,
                'bio',
            ]);

            Auth::login($user);

            return $this->dashProfessionell();

        } else {

            Client::create([
                'user_id' => $user->id
            ]);

            Auth::login($user);

            return $this->dashClient();
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
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

    public function compliteProfile(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'photo' => 'nullable|image|max:2048',
            'phone' => 'required|string|max:20',
        ]);
        $completeProfile = $request->only('photo', 'phone');

        return redirect()->route('dashboard')->with('success', 'Profil mis à jour !');
    }
}