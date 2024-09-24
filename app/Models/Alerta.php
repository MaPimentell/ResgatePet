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
        'localizacao_id',
        'exibir',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function animal(){
        return $this->belongsTo(Animais::class);
    }
    public function localizacao(){
        return $this->belongsTo(Localizacao::class);
    }
}
