<div x-data="{erro: @entangle('erro')}" class="container px-5 my-4">

    @for ($indice = 0; $indice < $this->divisao; $indice++)
        
        @if(!empty($this->subtopico_questoes[0]['QuestoesSemRespostaSub'][$indice]))

            <x-questao indice="{{$indice}}"></x-questao>

        @endif

    @endfor
</div>
