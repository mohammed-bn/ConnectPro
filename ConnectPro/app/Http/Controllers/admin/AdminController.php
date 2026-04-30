<?php

namespace App\Http\Controllers\admin;

use App\Models\Admin;
use App\Models\User;
use App\Models\Client;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Professionnel;
use App\Models\Speciality;
use App\Models\DemandeConsultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class AdminController extends Controller
{

    public function dachboardAdmin(){
        //le nomber totele de users et aussi chaque role
            $totalUsers = User::count();
            $totalProfessionnels = Professionnel::count();
            $totalAdmins = Admin::count();
            $totalClients = Client::count();

        //le nomber totale de user par rapport a la situation 
            $activeUsers = User::where('status', 'actif')->count();
            $bannedUsers = User::where('status', 'banned')->count();
        
        //les information pour les utilisateur
          $users = User::all();
          $client = Client::with('user')->get();
          $Professionnel = Professionnel::with(['user', 'specialty'])->get();
          $admin = Admin::with('user')->get();
        
        // les information pour post 
        $totalePost = Post::count();
        $totalePostProfessionnel = Post::whereHas('user', function($query) {
            $query->whereHas('professionnel');
        })->count();
        
        $totalePostClient = Post::whereHas('user', function($query) {
            $query->whereHas('client');
        })->count();

        // les information commnet 
        $totalComments = Comment::count();

        $commentsProfessionnel = Comment::whereHas('user', function($query) {
            $query->whereHas('professionnel');
        })->count();

        $commentsClient = Comment::whereHas('user', function($query) {
            $query->whereHas('client');
        })->count();
        


        $postPercentages = $this->calculePercentagePost(
            $totalePost, 
            $totalePostProfessionnel, 
            $totalePostClient
        );

        $commentPercentages = $this->calculePercentageComent(
            $totalComments,
            $commentsProfessionnel,
            $commentsClient,
        );

        $accountDistribution = [
            'users' => $totalUsers,
            'professionnels' => $totalProfessionnels,
            'clients' => $totalClients,
            'admins' => $totalAdmins,
            'total' => $totalClients + $totalProfessionnels + $totalAdmins
        ];
        
        // dd($accountDistribution);
        $accountPercentages = $this->calculateAccountPercentages(
            $accountDistribution['total'],
            $totalClients,
            $totalProfessionnels,
            $totalAdmins
        );
        $user = Auth::user();
        // dump($totalUsers);
        // dump($totalProfessionnels);
        // dump( $totalAdmins);
        // dump($totalClients);

        // dump($totalePost);
        // dump($totalePostProfessionnel);
        // dump( $totalePostClient);

        // dd($totalPost);
        return view('admin.dashboard',compact(
            'totalUsers',
            'totalProfessionnels',
            'totalAdmins',
            'totalClients',
            'users',
            'client',
            'Professionnel',
            'admin',
            'totalePost',
            'totalePostProfessionnel',
            'totalePostClient',
            'postPercentages',
            'totalComments',
            'commentPercentages', 
            'commentsProfessionnel',  
            'commentsClient',  
            'accountDistribution',
            'accountPercentages'
        )); 
    }



    //calcule procentage de postes pour professionnel et 
    public function calculePercentagePost($total, $professionnelCount, $clientCount)
    {
        if ($total == 0) {
            return [
                'professionnel' => 0,
                'client' => 0,
            ];
        }
        
        $percentageProfessionnel = round(($professionnelCount / $total) * 100, 2);
        $percentageClient = round(($clientCount / $total) * 100, 2);
        
        return [
            'professionnel' => $percentageProfessionnel,
            'client' => $percentageClient,
        ];
    }

    public function calculePercentageComent($total, $professionnelCount, $clientCount)
    {
        if ($total == 0) {
            return [
                'professionnel' => 0,
                'client' => 0,
            ];
        }
        
        return [
            'professionnel' => round(($professionnelCount / $total) * 100, 2),
            'client' => round(($clientCount / $total) * 100, 2),
        ];
    }

    public function calculateAccountPercentages($total, $clients, $professionnels, $admins)
    {
        if ($total == 0) {
            return [
                'users' => 0,
                'professionnels' => 0,
                'admins' => 0,
            ];
        }
        
        return [
            'clients' => round(($clients / $total) * 100, 2),
            'professionnels' => round(($professionnels / $total) * 100, 2),
            'admins' => round(($admins / $total) * 100, 2)
        ];
    }

}
