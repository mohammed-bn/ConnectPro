<?php

namespace App\Http\Controllers;

use App\Models\DemandeConsultation;
use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Professionnel;
use App\Models\Client;
use App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class DemandeConsultationController extends Controller
{


    public function sendRequest(Request $request, $professionalId)
    {
        // dd('test hal tasma3oni');

        if (!Auth::user()->client) {
            return redirect()->back()->with('error', 'Vous devez être un client pour envoyer une demande.');
        }
        $request->validate([
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);
        
        $professional = Professionnel::findOrFail($professionalId);
        $client = Auth::user()->client;
        
        // verification est ce que la demande de consultaion déja envoye ou bien non
        $estDejaExiste = DemandeConsultation::where('client_id', $client->id)
            ->where('professionnel_id', $professional->id)
            ->whereIn('status', ['Pending', 'Accepted'])
            ->exists(); 
               
        if ($estDejaExiste) {
            return redirect()->back()->with('error', 'Vous avez déjà une demande en cours avec ce professionnel.');
        }
        
        DemandeConsultation::create([
            'title' => $request->title,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'Pending',
            'client_id' => $client->id,
            'professionnel_id' => $professional->id,
        ]);
        
        return redirect()->back()->with('success', 'Votre demande de consultation a été envoyée avec succès !');
    }


    public function accept($id)
    {

        $demande = DemandeConsultation::findOrFail($id);
    
    
        $professionnel_id = auth()->user()->professionnel->id;
        if ($demande->professionnel_id != $professionnel_id) { 
            abort(403); 
        }

    
        $demande->update(['status' => 'Accepted']);


        Conversation::create([
            'demande_consultations_id'=>$demande->id,
        ]);

        return redirect()->back()->with('success', 'La demande de consultation a été acceptée');
    }



    public function refuse($id)
    {
        $demande = DemandeConsultation::findOrFail($id);

        $demande->update(['status' => 'Refused']);

        return redirect()->back()->with('error', 'La demande de consultation a été rejetée');
    }


    public function mesDemandeconsultation()
    {
        $user = Auth::user();
    
        $demandes = DemandeConsultation::where('client_id', $user->client->id)
            ->with(['professionnel.user', 'professionnel.specialty'])
            ->orderBy('created_at', 'desc')
            ->get();

        
        $totalAccepted = DemandeConsultation::where('client_id', $user->client->id)
            ->where('status', 'Accepted')
            ->count();
        
        $totalRefused = DemandeConsultation::where('client_id', $user->client->id)
            ->where('status', 'Refused')
            ->count();
    
    
        $totalPending = DemandeConsultation::where('client_id', $user->client->id)
            ->where('status', 'Pending')
            ->count();
    
        // dd($totalAccepted);
        // dd($totalRefused);
        // dd($totalPending);
        return view('utilisateur.notificationMessage', compact('demandes',
            'totalAccepted',
            'totalRefused',
            'totalPending'
        ));
    }

    // Pour les professionnels
    public function Notification(){
        $user = Auth::user();
        
        if (!$user->professionnel) {
            abort(403, 'Accès non autorisé');
        }
        
        $demandes = DemandeConsultation::where('professionnel_id', $user->professionnel->id)
            ->with(['client.user'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        $pendingCount = $demandes->where('status', 'Pending')->count();
    
    return view('notificationMessage', compact('demandes', 'pendingCount'));
}


 
}
