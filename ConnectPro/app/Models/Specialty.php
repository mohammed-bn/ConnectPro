<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $fillable = [
        'title',
    ];

    public function professionals(){
        return $this->hasMany(Professionnel::class);
    }
}
