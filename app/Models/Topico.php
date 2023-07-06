<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topico extends Model
{
    use HasFactory;

    protected $table = 'topicos';

    protected $fillable = [
        'titulo', 
        'alternativas'
    ];

    protected $casts = [
        'alternativas' => 'array',
    ];

    public function subtopicos()
    {
        // Possui 0 ou muitos Subtopicos
        return $this->hasMany(Subtopico::class);
    }
}
