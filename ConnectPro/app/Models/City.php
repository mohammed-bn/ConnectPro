<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    protected $fillable = [
        'name',
        'region',
        'address',
    ];

    public function users(){
        return $this->hasMany(User::class);
    }
}
