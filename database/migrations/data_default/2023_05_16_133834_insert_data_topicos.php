<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Topico;
 


return new class extends Migration
{
    public function up()
    {
        $topicos = [
            [
                'titulo' => 'Grau de Inovação',
                'alternativas' => json_encode(['Baixo', 'Médio', 'Alto']),
            ],
            [
                'titulo' => 'Empreendedorismo Organizacional',
                'alternativas' => json_encode([
                    'Concordo totalmente', 
                    'Concordo', 
                    'Não concordo/nem discordo',
                    'Discordo',
                    'Discordo totalmente'
                ]),
            ],
            [
                'titulo' => 'Maturidade da Transformação Digital',
                'alternativas' => json_encode([
                    'Concordo totalmente', 
                    'Concordo', 
                    'Não concordo/nem discordo',
                    'Discordo',
                    'Discordo totalmente',
                    'Não sei(desconheço)'
                ]),
            ],
            [
                'titulo' => 'Empresa',
                'alternativas' => json_encode([
                    'Sim', 
                    'Não', 
                    'Desconheço'
                ]),
            ],
        ];

        foreach ($topicos as $topico) {
            Topico::create([
                'titulo' => $topico['titulo'],
                'alternativas' => json_encode($topico['alternativas']),
                'updated_at' => now(),
                'created_at' => now(),
            ]);
        }
    }

    public function down()
    {
        // Remova os registros inseridos na migração
        Topico::truncate();
    }
};
