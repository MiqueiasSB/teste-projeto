<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questao extends Model
{
    use HasFactory;

    protected $table = 'questoes';

    protected $fillable = [
        'subtopico_id',
        'pergunta', 
        'alternativas', 
        'ordem',
        'visivel'
    ];
    
    protected $casts = [
        'alternativas' => 'array',
    ];

    public function subtopico()
    {
        //Possui 1 e apenas 1 subtopico
        return $this->belongsTo(Subtopico::class);
    }

    public function resposta()
    {
         //Possui muitas Respostas
        return $this->hasMany(Resposta::class)->cascadeDelete();
    }
}
