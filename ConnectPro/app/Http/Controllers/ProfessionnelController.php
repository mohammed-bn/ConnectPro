<?php

namespace App\Http\Controllers;

use App\Models\Professionnel;
use Illuminate\Http\Request;

class ProfessionnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('profile.professionnel');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("hena");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $userId)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'bio'      => 'required|string|max:550',
            'specialty_id'  => 'required|specialties,id',
        ]);

        $user = User::create([
            'category' => $request->category,
            'bio'      => $request->bio,
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
