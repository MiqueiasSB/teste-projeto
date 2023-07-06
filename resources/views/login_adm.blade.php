@extends('layouts.main')

@section('titulo', 'EITD - Dados da Empresa')

@section('conteudo')

    <div class="container mt-5">
        <div class="row mt-5 pt-5 h-100 d-flex align-items-center justify-content-center">

            <div class="row align-items-center justify-content-center">
                <div class="col-md-4 col-sm-10 col-11   text-center">
                    <x-icon.logo></x-icon.logo>
                </div>
            </div>
            <form action="/verifica-login-adm" method="POST">
                @csrf

                <div class="row align-items-center justify-content-center mt-3">

                    <div class="col-md-4 col-10 text-center">
                        <label for="senha" class="form-label h2">Login ADM</label>
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <input type="password" name="senha" class="form-control" id="senha" value=""
                            placeholder="Senha">
                        <button type="submit" class="btn btn-primary w-100 mt-3">Entrar</button>
                    </div>
                </div>
            </form>


        </div>
    </div>

@endsection
