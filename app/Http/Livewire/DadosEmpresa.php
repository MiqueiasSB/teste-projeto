<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Redirect;
use App\Models\Topico;
use App\Models\Questao;
use App\Models\Resposta;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class DadosEmpresa extends Component {

    public $usuario;
    public $resposta; //Corresponde á linha na tabela Resposta

    public $respostaAtual; //Corresponde ao resultado da questao em sim
    public $respostaOutro; // Guarda á especificação do campo Outro

    public $questoesRespondidas;

    public $todasAsQuestoes;
    public $questoesSemRespostas;

    public $quantidadeTotal;
    public $quantidadeSemRespostas;

    public $posicao;
    public $voltar = 0;
    public $questaoAtual;
    public $alternativas;

    /* %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% DADOS INICIAIS %%%%%%%%%%%%% */
    public function mount() {
        $this->usuario = Auth::user();

        $this->todasAsQuestoes = Questao::All()->where('subtopico_id', 19);
        $this->quantidadeTotal = $this->todasAsQuestoes->count();

        $this->atualizarDados();
    }

    /* %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% NAVEGAÇÃO %%%%%%%%%%%%% */

    public function proximo() {
        
        if ($this->voltar > 0) { //Está prossegindo depois de ter voltado

            $this->voltar -= 1;

            //Recupera Resposta
            $this->resposta = Resposta::all()
                ->where('questao_id', $this->questaoAtual->id)
                ->where('user_id', $this->usuario->id)
                ->first();

            $this->atualizaResposta();

            //Controle de fluxo
            $posicao_voltada = $this->questoesRespondidas->count() - $this->voltar;

            if ($posicao_voltada < $this->posicao) {
                //Só é executado para questoes que ja foram respondidas

                $this->questaoAtual = $this->questoesRespondidas[$posicao_voltada];

                $this->resposta = Resposta::all()
                    ->where('questao_id', $this->questaoAtual->id)
                    ->where('user_id', $this->usuario->id)
                    ->first();

                $this->alternativas = $this->verificaAlternativas($this->questaoAtual);

                $this->respostaAtual = $this->resposta->resultado;
            } else {
                $this->atualizarDados();
                /* 
                    Quando está condição for falsa quer dizer que ele está prosseguindo para 
                    a ultima questão que ele parou, ou seja, ainda não possui resposta 
                    Então volta para o fluxo padrão
                */
            }
        
        } else { //Está prossegindo para perguntas ainda não respondidas
            $this->criateResposta();
            $this->atualizarDados();
        }

    }

    public function voltar() {

        if ($this->voltar > 0) {
            //Recupera Resposta
            $this->resposta = Resposta::all()
                ->where('questao_id', $this->questaoAtual->id)
                ->where('user_id', $this->usuario->id)
                ->first();

            $this->atualizaResposta();
        }

        $this->voltar += 1;

        $this->questoesRespondidas = Questao::whereIn('id', function ($query) {
            $query->select('questao_id')
                ->from('respostas')
                ->where('user_id', $this->usuario->id);
        })->where('subtopico_id', 19)->orderBy('ordem')->get();


        $posicao_voltada = $this->questoesRespondidas->count() - $this->voltar;

        $this->questaoAtual = $this->questoesRespondidas[$posicao_voltada];

        $this->respostaAtual = Resposta::All()->where('questao_id', $this->questaoAtual->id)
            ->where('user_id', $this->usuario->id)->first()->resultado;


        $this->alternativas = $this->verificaAlternativas($this->questaoAtual);

    }

    /* %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% BD - CREAT E UPDATE %%%%%%%%%%%%% */
    public function criateResposta() {
        $this->validate([
            'respostaAtual' => 'required',
        ]);

        $this->verificaOutro();

        $this->resposta = Resposta::create([
            'user_id' => $this->usuario->id,
            'questao_id' => $this->questaoAtual->id,
            'resultado' => $this->respostaAtual,

            'updated_at' => now(),
            'created_at' => now()
        ]);
    }

    public function atualizaResposta() {
        $this->validate([
            'respostaAtual' => 'required',
        ]);

        $this->verificaOutro();

        $this->resposta->update([
            'resultado' => $this->respostaAtual,
            'updated_at' => now(),
        ]);
    }
    /* %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% ATUALIZAÇÃO DE DADOS %%%%%%%%%%%%% */

    public function atualizarDados() {

        $this->respostaAtual = '';

        $this->questoesSemRespostas = Questao::whereNotIn('id', function ($query) {
            $query->select('questao_id')
                ->from('respostas')
                ->where('user_id', $this->usuario->id);
        })->where('subtopico_id', 19)->get();

        if ($this->questoesSemRespostas->isEmpty()) {
            // Se todas as questões foram respondidas

            return Redirect::route('questionario_g_inovacao');
        }

        $this->quantidadeSemRespostas = $this->questoesSemRespostas->count();

        //Inicia pela primeira questão sem resposa sempre
        $this->questaoAtual = $this->questoesSemRespostas[0];

        $this->posicao = $this->quantidadeTotal - $this->quantidadeSemRespostas;

        $this->alternativas = $this->verificaAlternativas($this->questaoAtual);

        $this->desmarcarRadios();
    }
    public function atualizaRespostaOutro() {
       
        if (!empty($this->respostaAtual) && !in_array($this->respostaAtual, $this->alternativas) && in_array('Outro', $this->alternativas)) {

            $this->marcaOutro();
            $this->respostaOutro =  $this->respostaAtual;
            $this->respostaAtual = 'Outro';
        }
    }

    public function updatedRespostaAtual() {
        if ($this->respostaAtual != 'Outro') {

            $this->respostaOutro = '';
        }
    }

    /* %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% VERIFICAÇÕES %%%%%%%%%%%%% */

    public function verificaAlternativas($questao) {

        $alternativas = Topico::All()->where('titulo', 'Empresa')->first()->alternativas;

        // Decodifica o atributo JSON como objeto
        $alternativas = json_decode($alternativas);

        if ($questao->alternativas) {
            //Se a quesão possuir alternativas proprias então se utiliza
            //Se Não, então utiliza as alternativas do topico geral
            $alternativas = $questao->alternativas;
        }

        // Decodifica o atributo JSON como array associativo
        $alternativas = json_decode($alternativas, true);

        return $alternativas;
    }
    public function  verificaOutro() {

        if ($this->respostaAtual == 'Outro') {
            $this->marcaOutro();

            $messages = [
                'respostaOutro.required' => "! Especifique o campo 'Outro'",
            ];

            $this->validate([
                'respostaOutro' => 'required',
            ], $messages);
        }
        if (!empty($this->respostaOutro)) { //Existe
            //Ele atribui a resposta ao valor que foi especificado em 'Outro'
            $this->respostaAtual = $this->respostaOutro;
        }
    }

    /* %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% FUNÇÕES JAVASCRIPT %%%%%%%%%%%%% */

    public function desmarcarRadios() {
        //Chama uma função declarada em resouses/funcoes.js
        $this->emit('desmarcarRadios');
    }
    public function marcaOutro() {
        //Chama uma função declarada em resouses/funcoes.js
        $this->emit('marcaOutro');
    }

    /* %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 0 RENDER 0 %%%%%%%%%%%%% */
   
    public function render() {

        return view('livewire.dados-empresa');
    }
}
