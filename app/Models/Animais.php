<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animais extends Model
{
    use HasFactory;

    protected $table = 'animais';

    protected $fillable = [
        'user_id',
        'nome',
        'sexo',
        'idade',
        'tipo',
        'raca',
        'foto'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
