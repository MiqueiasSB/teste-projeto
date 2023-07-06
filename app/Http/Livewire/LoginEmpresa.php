<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;

class LoginEmpresa extends Component {

    public $usuario;

    public $nome = 'Empresa Teste';
    public $email = 'test@tes.com';
    public $cnpj = '39.257.538/0001-11';


    public function enviar() {

        $this->validate([
            'nome' => 'required|max:255',
            'email' => 'required|email',
            'cnpj' => 'cnpj'
        ]);

        //Verificar se o Usuario já existe
        $this->usuario = User::where('email', $this->email)->first();

        if ($this->usuario) { // O usuário existe no banco de dados
            Auth::login($this->usuario);
            return Redirect::route('dados_empresa');
            /*
                if ($this->usuario->completo) { //O usuário já Completou o Formulário

                } else { //O usuário NÃO Completou o Formulário

                    $this->nome = 'Já existe mas não completou o Formulário';
                }
            */
        } else { //Não Existe

            $this->createUser();

            Auth::login($this->usuario);
            return Redirect::route('dados_empresa');
        }
    }

    public function createUser() {
        //Cria novo Usuário
        $this->usuario = User::create([
            'name' => $this->nome,
            'email' => $this->email,
            'cnpj' => $this->cnpj,

            'updated_at' => now(),
            'created_at' => now()
        ]);
    }

    public function updatedCnpj() {
        // Remove caracteres não numéricos do CNPJ
        $this->cnpj = preg_replace('/[^0-9]/', '', $this->cnpj);

        // Aplica a máscara do CNPJ
        $this->cnpj = preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $this->cnpj);
    }

    public function render() {
        return view('livewire.login-empresa');
    }
}
