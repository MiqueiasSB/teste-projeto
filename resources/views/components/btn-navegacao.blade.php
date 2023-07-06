<div class="mx-5 my-2">
    <div class="row justify-content-end">

        {{--  @if ($voltar != $posicao)--}}
            {{-- Desaparece na primeira pergunta --}}
            <div class="col-2">
                <button wire:click="voltar()" class="btn btn-secondary w-100">Voltar</button>
            </div>
        {{-- @endif --}}


        <div class="col-2">
            <button wire:click="proximo()" class="btn btn-primary w-100">Próximo</button>
        </div>



    </div>
</div>