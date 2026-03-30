<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Professionnel;
use Illuminate\Support\Facades\Auth;

class ChooseAccountController extends Controller
{
    /**
     * Afficher la page de choix
     */
    public function index()
    {
        return view('auth.choose-account');
    }


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

    //chois client ou professionnel
    public function store(Request $request)
    {
        $user = $request->user();
 
        if ($request->account_type === 'professional')
        {
            Professionnel::create([
                'user_id' => $user->id,
                'category' => 'sdfghjkl',
                'spesialitie_id' => 1,
                'bio' => 'dfghjk',
            
            ]);
            return $this->dashProfessionell();

        }elseif ($request->account_type === 'client') {

            Client::create(['user_id' => $user->id]);
            return $this->dashClient();

        }   
    }

}