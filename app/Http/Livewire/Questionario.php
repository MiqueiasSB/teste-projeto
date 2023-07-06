<?php

namespace App\Http\Livewire;

use App\Models\Questao;
use App\Models\Resposta;
use App\Models\Subtopico;
use App\Models\Topico;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;


class Questionario extends Component {

    public $usuario;

    public $resposta;
    public $respostaAtual = [];
    public $questaoAtual;
    public $alternativas;

    public $topico;
    public $todasAsQuestoesTopico;
    public $questoesSemRespostasTopico;
    public $quantidadeTopico;

    public $subtopicos;
    //Cada indice representa um subtopico
    //Dentro dele há dois valores [Id do subtopico , Os IDs das questões não respondidas]
    public $subtopico_questoes;

    public $subtopicoAtual;
    public $quantidadeSub;
    public $posicaoSub;

    public $divisao;
    public $posicao;
    public $voltar = 0;
    public $erro;

    public function mount() {

        $this->usuario = Auth::user();

        //Recupera o Objedo pelo id do topico passado pelo componente
        $this->topico = Topico::find($this->topico);
        
        $this->subtopicos = Subtopico::all()->where('topico_id', $this->topico->id);

        $this->todasAsQuestoesTopico = Questao::whereHas('subtopico', function ($query) {
            $query->where('topico_id', $this->topico->id);
        })->get();

        $this->atualizaDados();
    }

    public function atualizaDados() {

        $this->questoesSemRespostasTopico =  Questao::whereNotIn('id', function ($query) {
            $query->select('questao_id')
                ->from('respostas')
                ->where('user_id', $this->usuario->id);
        })->whereHas('subtopico', function ($query) {
            $query->where('topico_id',  $this->topico->id);
        })->get();

        $this->quantidadeTopico = $this->todasAsQuestoesTopico->count();
        $this->posicao = $this->quantidadeTopico - $this->questoesSemRespostasTopico->count();
        //dd($this->questoesSemRespostasTopico);

        //Verificar quais subtopicos não estão completamente respondidos
        $this->verificaSubtopicosSemResposta();
        
        //É o primeiro Subtopico com qestoes sem responder
        $this->subtopicoAtual = Subtopico::find($this->subtopico_questoes[0]['subtopico_id']);
        $this->quantidadeSub = $this->subtopico_questoes[0]['quantidade_total'];
        $this->posicaoSub =  $this->quantidadeSub - count($this->subtopico_questoes[0]['QuestoesSemRespostaSub']);

        //dd($this->subtopico_questoes[0]['QuestoesSemRespostaSub'][0]->pergunta);
    }

    public function verificaSubtopicosSemResposta() {
        //Percorre todos os subtopicos
        foreach ($this->subtopicos as $key => $subtopico) {

            $questoesSemRespostas = Questao::whereNotIn('id', function ($query) {
                $query->select('questao_id')
                    ->from('respostas')
                    ->where('user_id', $this->usuario->id);
            })->where('subtopico_id', $subtopico->id)->get();

            //Abstrai apenas os IDs das questões e guara em um array
            foreach ($questoesSemRespostas as $k => $questao) {
                $questoes[$k] = $questao;
            }

            $todasAsQuestoesSub = Questao::where('subtopico_id', $subtopico->id)->count();

            //Verificar se $questoes_id não está vazia

            if ($todasAsQuestoesSub != 0) {
                //Cada indice representa um subtopico
                //Dentro dele há dois valores [Id do subtopico , Os IDs das questões não respondidas]
                $this->subtopico_questoes[$key] = [
                    'subtopico_id' => $subtopico->id,
                    'QuestoesSemRespostaSub' => $questoes,
                    'quantidade_total' => $todasAsQuestoesSub
                ];
            }
        }
        //Reorganiza array apartir do indice 0
        $this->subtopico_questoes = array_values($this->subtopico_questoes);
    }

    public function proximo(){
        $this->erro = [];

        //dd($this->respostaAtual);
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
            
        }

    }
    public function voltar(){
        
    }

    public function criateResposta(){

        if($this->verificaResposta()){
            dd('Guarda resposta');
            //$this->atualizarDados();
        }
        
    }

    public function verificaResposta(){

        for($i=0; $i<$this->divisao; $i++){
            if(!empty($this->subtopico_questoes[0]['QuestoesSemRespostaSub'][$i])){

                if(empty($this->respostaAtual[$i])){
                    $this->erro[$i] = 'Vazia';
                }
            
            }
        }
        return empty($this->erro);
       

    }

    public function render() {
        return view('livewire.questionario');
    }
}
