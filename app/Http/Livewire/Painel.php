<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;


use App\Models\Questao;
use App\Models\Resposta;
use App\Models\Subtopico;
use App\Models\Topico;
use App\Models\User;

use Livewire\Component;

class Painel extends Component {
    use WithPagination;

    protected $empresas;
    public $empresas_array;

    public $quantidadeQuestoes;
    //Filtros
    public $filtros = [];

    public $topico;
    public $subtopicos;
    public $titulosSub = [];
    public $medias = [];
    public $mediaGeral;
    public $menorMedia;

    public $cor1 = "primary";

    public function mount() {
        $this->dadosGraficos();


        $this->filtros = [
            'pesquisa' => '',
            'status' => 'Todos',
            'metodologia' => []
        ];

        $this->empresas = User::where('id', '<>', 1)->orderByDesc('updated_at')->paginate(10);
        $this->empresas_array = $this->empresas->toArray()['data'];
        $this->formataData();
    }

    public function formataData() {
        foreach ($this->empresas_array as $key => $empresa) {
            $this->empresas_array[$key]['updated_at'] = Carbon::parse($empresa['updated_at'])->format('d/m/Y - H:i');
        }
    }

    public function updatedFiltros(){
        $this->aplicaFiltros();
    }
    public function aplicaFiltros($dados = false) {

       if($dados){
            $this->filtros['status'] = $dados['status'];
            $this->filtros['metodologia'] = $dados['metodologia'];
       }
        
        $this->empresas = User::where('id', '!=', 1)
        ->where(function ($query) {
            $query->where('name', 'like', '%' . $this->filtros['pesquisa'] . '%')
                ->orWhere('cnpj', 'like', '%' . $this->filtros['pesquisa'] . '%')
                ->orWhere('email', 'like', '%' . $this->filtros['pesquisa'] . '%');
        })
        ->orderByDesc('updated_at');

        if ( $this->filtros['status'] === 'Finalizados') {
            $this->empresas->whereHas('respostas', function ($query) {
                $query->groupBy('user_id')->havingRaw('COUNT(*) = ' . $this->quantidadeQuestoes);
            });
        }
        elseif ( $this->filtros['status'] === 'Andamento') {
            $this->empresas->whereHas('respostas', function ($query) {
                $query->groupBy('user_id')->havingRaw('COUNT(*) < ' . $this->quantidadeQuestoes);
            });
        }

        $this->empresas = $this->empresas->paginate(10);
       
       $this->empresas_array = $this->empresas->toArray()['data'];
       $this->formataData();

    }
    public function dadosGraficos() {
        $this->quantidadeQuestoes = Questao::all()->count();

        $usuariosCompletos = User::whereHas('respostas', function ($query) {
            $query->groupBy('user_id')->havingRaw('COUNT(*) =' . $this->quantidadeQuestoes);
        })->get();

        //dd( $usuariosCompletos );
    }

    public function redirecionar($user_id){
        return redirect()->route('painel_user', ['user_id' => $user_id]);

    }

    public function render() {
        return view('livewire.painel');
    }
}
