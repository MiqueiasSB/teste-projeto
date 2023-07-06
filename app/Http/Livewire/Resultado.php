<?php

namespace App\Http\Livewire;

use App\Models\Questao;
use App\Models\Resposta;
use App\Models\Subtopico;
use App\Models\Topico;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class Resultado extends Component {

    public $usuario;

    public $titulo;
    public $topico;
    public $subtopicos;
    public $titulosSub = [];
    public $medias = [];
    public $mediaGeral;
    public $menorMedia;
    public $respostas;

    public $cor1;
    public $cor2;

    public function mount() {

        $this->usuario = Auth::user();


        //Recupera o Objedo pelo id do topico passado pelo componente
        $this->topico = Topico::find($this->topico);
        $this->titulo = $this->topico->titulo;

        $this->subtopicos = Subtopico::all()->where('topico_id', $this->topico->id);

        if ($this->topico->id == 4) {
            $this->verificaMaturidade();
        }
        if ($this->topico->id == 3) {
            $this->verificaOrientacao();
        }
        if ($this->topico->id == 2) {
            $this->verificaInovacao();
        }
    }
    public function verificaInovacao() {
        foreach ($this->subtopicos as $subtopico) {
            $resultados = Resposta::where('user_id', $this->usuario->id)
                ->whereHas('questao', function ($query) use ($subtopico) {
                    $query->where('subtopico_id', $subtopico->id);
                })
                ->pluck('resultado');

            $somaResultados = 0;

            foreach ($resultados as $resultado) {

                switch ($resultado) {
                    case 'Baixo':
                        $somaResultados += 1;
                        break;
                    case 'Médio':
                        $somaResultados += 3;
                        break;
                    case 'Alto':
                        $somaResultados += 5;
                        break;
                }
            }

            $this->medias[] = number_format($somaResultados /  $resultados->count(), 2, '.', '');
            $this->titulosSub[] = $subtopico->titulo;
        }
        $this->mediaGeral = array_sum($this->medias) / count($this->medias);
    }

    public function verificaOrientacao() {
        foreach ($this->subtopicos as $subtopico) {
            $resultados = Resposta::where('user_id', $this->usuario->id)
                ->whereHas('questao', function ($query) use ($subtopico) {
                    $query->where('subtopico_id', $subtopico->id);
                })
                ->pluck('resultado');

            $somaResultados = 0;

            foreach ($resultados as $resultado) {

                switch ($resultado) {
                    case 'Concordo totalmente':
                        $somaResultados += 5;
                        break;
                    case 'Concordo':
                        $somaResultados += 4;
                        break;
                    case 'Não concordo/nem discordo':
                        $somaResultados += 3;
                        break;
                    case 'Discordo':
                        $somaResultados += 2;
                        break;
                    case 'Discordo totalmente':
                        $somaResultados += 1;
                        break;
                }
            }

            $this->medias[] = number_format($somaResultados /  $resultados->count(), 2, '.', '');
            $this->titulosSub[] = $subtopico->titulo;
        }
        $this->mediaGeral = array_sum($this->medias) / count($this->medias);
    }

    public function verificaMaturidade() {
        foreach ($this->subtopicos as $subtopico) {
            $resultados = Resposta::where('user_id', $this->usuario->id)
                ->whereHas('questao', function ($query) use ($subtopico) {
                    $query->where('subtopico_id', $subtopico->id);
                })
                ->pluck('resultado');

            //Troca o texto por o valor
            foreach ($resultados as $key => $resultado) {

                switch ($resultado) {
                    case 'Concordo totalmente':
                        $resultados[$key] = 4;
                        break;
                    case 'Concordo':
                        $resultados[$key] = 3;
                        break;
                    case 'Não concordo/nem discordo':
                        $resultados[$key] = 2;
                        break;
                    case 'Discordo':
                        $resultados[$key] = 1;
                        break;
                    case 'Discordo totalmente':
                        $resultados[$key] = 0;
                        break;
                    case 'Não sei(desconheço)':
                        $resultados[$key] = 0;
                        break;
                }
            }

            $resultadosPorSub[] = $resultados;
        }


        //Segmentos
        $this->titulosSub = [
            'Promover e Apoiar',
            'Criar e Construir',
            'Compromisso com a Transformação Digital',
            'Processos Centrados no Usuário',
            'Empresa Orientada a Dados'
        ];

        /*
            Subtopicos -1
            [0, 'Dimensão Experiência do Cliente'],
            [1, 'Dimensão Inovação de Produto'],
            [2, 'Dimensão Estratégia'],
            [3, 'Dimensão Organização'],
            [4, 'Dimensão Digitalização de processos'],
            [5, 'Dimensão Colaboração'],
            [6, 'Dimensão Tecnologia da Informação'],
            [7, 'Dimensão Cultura e Especialização'],
            [8, 'Dimensão Gestão de Transformação'],
        */

        $relacionamentosPorSegmento = [
            // [Subtopico][Pergunta]
            [ //Promover e Apoiar
                $resultadosPorSub[5][2],
                $resultadosPorSub[5][3],
                $resultadosPorSub[5][4],
                $resultadosPorSub[5][5],

                $resultadosPorSub[7][2],

                $resultadosPorSub[0][0],
                $resultadosPorSub[0][1],

                $resultadosPorSub[6][9],
                $resultadosPorSub[6][3],
                $resultadosPorSub[6][4],

                $resultadosPorSub[3][0],
                $resultadosPorSub[3][1],

                $resultadosPorSub[1][0],

                $resultadosPorSub[2][3],
                $resultadosPorSub[2][4],
                $resultadosPorSub[2][5],
                $resultadosPorSub[2][6],

                $resultadosPorSub[8][4],
                $resultadosPorSub[8][5],
                $resultadosPorSub[8][6]
            ],

            [ //Criar e Construir
                $resultadosPorSub[5][0],
                $resultadosPorSub[5][1],

                $resultadosPorSub[7][1],
                $resultadosPorSub[7][6],

                $resultadosPorSub[6][0],
                $resultadosPorSub[6][5],
                $resultadosPorSub[6][6],

                $resultadosPorSub[3][6],

                $resultadosPorSub[4][0],
                $resultadosPorSub[4][3],

                $resultadosPorSub[1][1],
                $resultadosPorSub[1][2],

                $resultadosPorSub[2][1],
                $resultadosPorSub[2][2],
            ],

            [ //Compromisso com a transformação digital
                $resultadosPorSub[7][0],
                $resultadosPorSub[7][3],
                $resultadosPorSub[7][4],
                $resultadosPorSub[7][5],

                $resultadosPorSub[6][7],
                $resultadosPorSub[6][8],

                $resultadosPorSub[3][3],
                $resultadosPorSub[3][5],

                $resultadosPorSub[4][4],

                $resultadosPorSub[1][3],

                $resultadosPorSub[8][0],
                $resultadosPorSub[8][1],
            ],

            [ //Processos Centrados no usuário
                $resultadosPorSub[0][2],
                $resultadosPorSub[0][5],

                $resultadosPorSub[6][1],
                $resultadosPorSub[6][2],

                $resultadosPorSub[3][4],

                $resultadosPorSub[4][1],
                $resultadosPorSub[4][5],

                $resultadosPorSub[1][4],
                $resultadosPorSub[1][5],

                $resultadosPorSub[2][0],

                $resultadosPorSub[8][3],
            ],

            [ //Empresa orientada a dados
                $resultadosPorSub[0][3],
                $resultadosPorSub[0][4],
                $resultadosPorSub[0][6],

                $resultadosPorSub[3][2],

                $resultadosPorSub[4][2],
                $resultadosPorSub[4][6],

                $resultadosPorSub[8][2],
            ],
        ];

        foreach ($relacionamentosPorSegmento as $key => $segmento) {
            $this->medias[] = number_format(array_sum($segmento) / count($segmento), 2, '.', '');
        }

        $this->menorMedia = min($this->medias);
    }

    public function render() {
        return view('livewire.resultado');
    }
}
