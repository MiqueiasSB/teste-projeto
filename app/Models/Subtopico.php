<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtopico extends Model
{
    use HasFactory;

    protected $table = 'subtopicos';
    protected $fillable = [
        'topico_id',
        'titulo'
    ];

    public function topico()
    {
        //Possui 1 e apenas 1 topico
        return $this->belongsTo(Topico::class);
    }

    public function questao()
    {
        //Possui 0 ou muitas questões
        return $this->hasMany(Questao::class);
    }
}
