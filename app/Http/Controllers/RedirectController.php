<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questao;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class RedirectController extends Controller {
    public function dados_empresa() {

        if ($this->dadosEmpresaCompleto()) {
            // Se todas as questões foram respondidas
            return Redirect::route('questionario_g_inovacao');
        }

        return view('dados_empresa');
    }

    public function questionario_g_inovacao() {

        if (!$this->dadosEmpresaCompleto()) {
            // Os dados da empresa não foram completados
            return Redirect::route('dados_empresa');
        }

        return view('questionarios.g_inovacao');
    }

    public function dadosEmpresaCompleto() {
        $questoesSemRespostas = Questao::whereNotIn('id', function ($query) {
            $query->select('questao_id')
                ->from('respostas')
                ->where('user_id', Auth::user()->id);
        })->where('subtopico_id', 19)->get();

        if ($questoesSemRespostas->isEmpty()) {
            // Se todas as questões foram respondidas
            return true;
        }
    }
}
