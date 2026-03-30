<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spesiality extends Model
{
    protected $fillable = [
        'title',
    ];

    public function professionels(){
        return $this->hasMany(professionel::class);
    }
}
