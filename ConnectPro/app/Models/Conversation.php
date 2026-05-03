<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{

    protected $fillable = [
        'demande_consultations_id'
    ];

    public function demandeConsultation(){
        return $this->belongsTo(DemandeConsultation::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }
}
