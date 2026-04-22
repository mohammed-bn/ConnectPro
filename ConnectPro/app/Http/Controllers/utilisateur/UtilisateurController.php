<?php

namespace App\Http\Controllers\utilisateur;

use App\Models\Client;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.user');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $userId)
    {
        $user = User::create([
            'user_id' => $userId,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Professionnel $professionnel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Professionnel $professionnel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Professionnel $professionnel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Professionnel $professionnel)
    {
        //
    }
}
