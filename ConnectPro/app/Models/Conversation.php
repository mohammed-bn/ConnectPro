<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public function professionnel(){
        return $this->belongsTo(Professionnel::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function messages(){
        return $this->hasMany(message::class);
    }
}
