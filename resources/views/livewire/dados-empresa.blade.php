<div>

    <x-barra-progresso quantidade="{{ $quantidadeTotal }}" posicao="{{ $posicao }}" voltar="{{ $voltar }}" cor="secondary">
    </x-barra-progresso>

    <x-legenda-usuario nome="{{ $usuario->name }}" email="{{ $usuario->email }}" cnpj="{{ $usuario->cnpj }}">
    </x-legenda-usuario>
    
    @php
        $this->atualizaRespostaOutro();
    @endphp

    <x-layout-dados-empresa pergunta="{{ $questaoAtual->pergunta }}" posicao="{{ $posicao }}" voltar="{{ $voltar }}">

        @foreach ($alternativas as $alternativa)
            <div class="form-check mb-2 custom-radio">

                <input class="form-check-input " type="radio" name="resposta" id="{{ $alternativa }}"
                    {{ $respostaAtual == $alternativa && $voltar > 0 ? "checked='true'" : ' ' }}
                    wire:click="$set('respostaAtual', '{{ $alternativa }}')">

                <label class="form-check-label fs-5" for="{{ $alternativa }}">
                    {{ $alternativa }}
                </label>

            </div>

        @endforeach
        
        @if ($respostaAtual == 'Outro')
            <input class="form-control form-control-sm" wire:model="respostaOutro"  type="text"placeholder="Qual?">
        @endif


    </x-layout-dados-empresa>

</div>
