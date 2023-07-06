<div class="container mt-5 text-center " style="padding-top: 10em">

    <div class="row justify-content-center">
        <div class="col-md-10 col-sm-12 col-12 ">
            <div class="row justify-content-center mb-3">
                <div class="col-lg-5 col-md-6 col-9 ">
                    <x-icon.logo></x-icon.logo>
                </div>
            </div>

            <div class="row justify-content-center mb-3">
                <div class="col-lg-6 col-md-9 col-sm-10 col-11">
 
                    @if ($errors->any())
                        <div class="text-danger text-start py-0">
                            <small>! Campo Obrigatório</small>

                            @if($errors->has('respostaOutro'))
                                <br>
                                <small>{{$errors->first('respostaOutro')}}</small>
                            @endif
                        
                        </div>
                    @endif

                    <p class="fs-4 text-start">{{ $pergunta }}</p>
                </div>
            </div>

            <div class="row justify-content-center mb-5">
                <div class="col-lg-6 col-md-7 col-sm-10 col-11 text-start">
                    {{ $slot }}
                </div>
            </div>

            <div class="row justify-content-end px-5 me-md-5">

                <div class="col-lg-5 col-md-7 col-9">

                    <div class="row justify-content-end pe-lg-5">

                        @if ($voltar != $posicao)
                            {{-- Desaparece na primeira pergunta --}}
                            <div class="col-6">
                                <button wire:click="voltar()" class="btn btn-secondary w-100">Voltar</button>
                            </div>
                        @endif


                        <div class="col-6">
                            <button wire:click="proximo()" class="btn btn-primary w-100">Próximo</button>
                        </div>



                    </div>
                </div>


            </div>


        </div>
    </div>



</div>
