<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'animal_id',
        'exibir',
        'latitude',
        'longitude'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function animal(){
        return $this->belongsTo(Animais::class);
    }

}