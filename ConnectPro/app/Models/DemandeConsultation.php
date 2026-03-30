<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemandeConsultation extends Model
{
    protected $fillable = [
        'title',
        'subject',
        'message',
        'status',
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function professionnel(){
        return $this->belongsTo(Professionnel::class);
    }
}
