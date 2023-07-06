@extends('layouts.main')
 
@section('titulo', 'EITD - Maturidade e Transformação Digital')

@section('conteudo')

   <livewire:questionario  wire:key="Questionario"
      topico="4" 
      divisao="2"
      alternativas="alternativa-6"
      cor1="primary"
      cor2="secondary">
   </livewire:questionario>

@endsection
