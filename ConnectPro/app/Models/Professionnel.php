<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Speciality;

class Professionnel extends Model
{
    protected $fillable = [
        'user_id',
        'category',
        'speciality_id',
        'bio',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function demandeConsultation(){
        return $this->hasMany(DemandeConsultation::class);
    }

    public function specialty(){ 
        return $this->belongsTo(Speciality::class, 'speciality_id');
    }
}
