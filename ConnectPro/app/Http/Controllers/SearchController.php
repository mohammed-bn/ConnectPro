<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Professionnel;
use App\Models\Speciality;

class SearchController extends Controller
{

    public function searchProfessionals(Request $request)
    {
        $nom = $request->query('nom');          
        $categorie = $request->query('categorie'); 
        $specialite = $request->query('specialite');
        $ville = $request->query('ville');    
        $region = $request->query('region');  
        $query = Professionnel::with('user', 'specialty');
    
        if  (!empty($nom)) {
            $query->whereHas('user', function($q) use ($nom) {
                $q->where('name', 'LIKE', '%' . $nom . '%');
            });
        }
    
        if (!empty($categorie)) {
            $query->where('category', 'LIKE', '%' . $categorie . '%') ;
        }
    
        if (!empty ($specialite)) {
        
            $query->whereHas('specialty', function($q) use ($specialite) {
                $q->where('title', 'LIKE', '%' . $specialite . '%');
            });
        }
    
        if (!empty($ville)) {
            $query->whereHas('user', function($q) use ($ville) {
                $q->where('city', 'LIKE', '%' . $ville . '%');
            });
        }
    
        if (!empty($region)) {
            $query->whereHas('user', function($q) use ($region) {
                $q->where('region', 'LIKE', '%' . $region . '%');
            });
        }

        $professionnels = $query->get();
    
        $results = $professionnels->map(function($professionnel) {
            return [
                'id' => $professionnel->user_id,    
                'professionnel_id' => $professionnel->id,
                'email' => $professionnel->user->email,      
                'name' => $professionnel->user->name,        
                'photo' => $professionnel->user->photo,      
                'phone' => $professionnel->user->phone,      
                'city' => $professionnel->user->city,       
                'region' => $professionnel->user->region,    
                'address' => $professionnel->user->address,  
                'category' => $professionnel->category,      
                'bio' => $professionnel->bio,               
                'speciality' => $professionnel->specialty?->title, 
            ];
        });

        return response()->json($results, 200);
    }
}