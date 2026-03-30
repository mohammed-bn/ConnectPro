<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['user_id'];

    public function user(){
        return $tihs->belongsTo(User::class);
    }

    public function conversation(){
        return $this->hasMany(conversation::class);
    }
}
