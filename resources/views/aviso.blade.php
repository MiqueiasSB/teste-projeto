@extends('layouts.main')

@section('titulo', 'Diagnóstico EITD')

@section('conteudo')

   <x-inicial 
      paragrafo="Este diagnóstico pode demorar até x minutos e só pode ser feito uma vez, então se organize e verifique se sua conexão com a internet  é estável."
      rota="/login"
      btn="Continuar"
   ></x-inicial>

@endsection
