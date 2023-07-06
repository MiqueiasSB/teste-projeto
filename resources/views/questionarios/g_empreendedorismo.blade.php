@extends('layouts.main')

@section('titulo', 'EITD - Empreendedorismo Organizacional')

@section('conteudo')

   <livewire:questionario  wire:key="Questionario"
      topico="3" 
      divisao="2"
      alternativas="alternativa-5"
      cor1="secondary"
      cor2="primary">
   </livewire:questionario>

@endsection
