<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Subtopico;

return new class extends Migration {

    public function up(): void {
        $subtopicos = [
            //Grau de Inovação
            [1, 'Dimensão Cliente'],
            [1, 'Dimensão Oferta'],
            [1, 'Dimensão Processos'],
            [1, 'Dimensão Presença'],

            //Empreendedorismo Organizacional
            [2, 'Dimensão Inovatividade'],
            [2, 'Dimensão Proatividade'],
            [2, 'Dimensão Assunção de riscos'],
            [2, 'Dimensão Agressividade Competitiva'],
            [2, 'Dimensão Autonomia'],

            //Maturidade da Transformação Digital
            [3, 'Dimensão Experiência do Cliente'],
            [3, 'Dimensão Inovação de Produto'],
            [3, 'Dimensão Estratégia'],
            [3, 'Dimensão Organização'],
            [3, 'Dimensão Digitalização de processos'],
            [3, 'Dimensão Colaboração'],
            [3, 'Dimensão Tecnologia da Informação'],
            [3, 'Dimensão Cultura e Especialização'],
            [3, 'Dimensão Gestão de Transformação'],

            //Empresa (Apenas para reutilizar o esquema já pronto)
            [4, 'Dados Empresa'],

        ];

        //Usei só os indices do array para diminuir a verbosidade
        foreach ($subtopicos as $subtopico) {
            Subtopico::create([
                'topico_id' => $subtopico[0],
                'titulo' => $subtopico[1],
                'updated_at' => now(),
                'created_at' => now(),
            ]);
        }
    }


    public function down(): void {
        // Remova os registros inseridos na migração
        Subtopico::truncate();
    }
};
