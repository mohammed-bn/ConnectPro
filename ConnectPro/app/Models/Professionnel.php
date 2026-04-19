<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professionnel extends Model
{
    protected $fillable = [
        'user_id',
        'category',
        'specialty_id',
        // 'title',
        'bio',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function conversation(){
        return $this->hasMany(Conversation::class);
    }

    public function specialty(){ 
        return $this->belongsTo(Specialty::class);
    }
}
