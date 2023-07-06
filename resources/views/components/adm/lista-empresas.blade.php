<div class="row justify-content-center border border-4 border-primary-active rounded py-3">
 
    <div class="row">
        <div class="col-5">
            <h2>Empresas</h2>
        </div>
        <div class="col-1">
            <x-adm.filtro></x-adm.filtro>
        </div>

        <div class="col-6 align-self-end">
            <div class="input-group mb-3">
                <input wire:model="filtros.pesquisa" type="text" class="form-control" placeholder="Pesquisar" aria-label="Pesquisar" aria-describedby="pesquisa">
                <span class="input-group-text" id="pesquisar"><i class="bi bi-search"></i></span>
              </div>
        </div>
    </div>

    <div class="row mt-2 px-sm-4 px-3">
        <table id="medias" class="table table-hover px-0 table-light table-striped table-bordered table-sm border border-3">
            <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nome</th>
                  <th scope="col">E-mail</th>
                  <th scope="col">CNPJ</th>
                  <th scope="col">Data</th>
                </tr>
              </thead>
            <tbody>
                @foreach ($this->empresas_array as $key => $empresa)
                    <tr wire:click="redirecionar({{$empresa['id']}})" style="cursor: pointer;">
                        <th class="text-start">{{ $key+1}}</th>
                        <td class="text-center">{{$empresa['name'] }}</td>
                        <td class="text-center">{{$empresa['email'] }}</td>
                        <td class="text-center">{{$empresa['cnpj'] }}</td>
                        <td class="text-center">{{$empresa['updated_at'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
