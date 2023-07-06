<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    use HasFactory;

    protected $table = 'respostas';

    protected $fillable = [
        'user_id', 
        'questao_id', 
        'resultado'
    ];

    public function questao()
    {
        //Possui 1 e apenas 1 questao
        return $this->belongsTo(Questao::class, 'questao_id');
    }

    public function usuario()
    {
        //Possui 1 e apenas 1 user
        return $this->belongsTo(User::class, 'user_id');
    }
}
