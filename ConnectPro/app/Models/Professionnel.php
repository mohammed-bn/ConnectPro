<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professionnel extends Model
{
    protected $fillable = [
        'user_id',
  
        'category',
        'spesialitie_id',
        'title',
        'bio',
    ];

    public function user(){
        return $this->belongTo(User::class);
    }

    public function conversation(){
        return $this->hasMany(Conversation::class);
    }
}
