<div class="container mt-5 text-center">

    <x-centralizar>

        <div class="row justify-content-center mb-3">
            <div class="col-lg-5 col-md-6 col-9 ">
                <x-icon.logo></x-icon.logo>
            </div>
        </div>

        <div class="row justify-content-center mb-3">
            <div class="col-md-6 col-sm-10 col-11">
                <p class="fs-3">Dados da Empresa</p>
            </div>
        </div>

        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 col-md-10 col-sm-11 col-12">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row justify-content-center text-start">

                    <div class="col-sm-6 col-10">

                        <div class="mb-2">
                            <label for="nome_empresa" class="form-label">Nome</label>
                            <input type="text" wire:model="nome" class="form-control" id="nome_empresa" required>
                        </div>

                        <div class="mb-2">
                            <label for="email_empresa" class="form-label">Email</label>
                            <input type="email" wire:model="email" class="form-control" id="email_empresa">
                        </div>

                        <div class="mb-2">
                            <label for="cnpj_empresa" class="form-label">CNPJ <small>(opcional)</small></label>
                            <input type="email" wire:model="cnpj" class="form-control"
                                id="cnpj_empresa">
                        </div>

                    </div>

                    <div class="col-sm-6 d-sm-block d-none text-center">

                        <i class="bi bi-buildings" style="font-size: 10em"></i>

                    </div>
                </div>

            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-7 col-9">
                <div class="row justify-content-end">
                    <button wire:click="enviar()" class="btn btn-primary col-md-4">Próximo</button>
                </div>
            </div>
        </div>
    </x-centralizar>


    
</div>
