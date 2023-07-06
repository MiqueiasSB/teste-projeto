<div x-data="{btnAtivo: ''}" class="mb-5 pb-5">    


   
    <div x-bind:class="(btnAtivo || '{{ empty($this->erro[$indice]) }}' )  ? 'bg-primary-light' : 'bg-danger-light'" class="row align-items-center rounded shadow shadow-lg p-2 mb-3 ">

        <div class="col-11">
            <h5 class="m-0 p-2 text-primary-dark" style="font-weight: 600;">
                {{ $this->subtopico_questoes[0]['QuestoesSemRespostaSub'][$indice]['pergunta'] }}
            </h5>
        </div>
        <div class="col-1 text-end ">
           
                <i x-show="btnAtivo" class="bi bi-check2-circle fs-3 text-primary"></i>
            
                @if(!empty($this->erro[$indice]))
                    {{-- Se a variavel retornar vazia e enquanto ele não marcar --}}
                    <i x-show="!btnAtivo"  class="bi bi-info-circle fs-3 text-danger"></i>
                @endif

           
        </div>
    </div>

    <div class="row justify-content-center">
        @if ($this->alternativas == 'nivel')

            <div class="col-6 btn-group btn-group-lg my-5" role="group" aria-label="Botoes Nivel">
                
                @foreach (['Baixo','Médio','Alto'] as $valor)
                    <button 
                        type="button" 
                        class="btn btn-outline-primary"
                        :class="{ 'btn-primary text-light': btnAtivo === '{{ $valor }}' }"
                        @click="btnAtivo = '{{ $valor }}';
                        $wire.set('respostaAtual.{{ $indice }}', '{{ $valor }}')">

                        {{  $valor }}
                    </button>
                @endforeach

            </div>
        @else

            @for ($i = 0; $i < 5; $i++)
                <div class="form-check mb-2 custom-radio ms-2">

                    <input class="form-check-input " type="radio" name="resposta">

                    <label class="form-check-label fs-5">
                        Alternativa
                    </label>

                </div>
            @endfor

        @endif
    </div>

</div>
