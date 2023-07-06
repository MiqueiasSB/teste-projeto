<div class="row mb-3 justify-content-center border border-4 border-primary-active rounded py-3">

    <div class="row">
        <div class="col-6">
            <h2>Dados empresa</h2>
        </div>

        <div class="col-6 align-self-end">
            <div class="input-group mb-3">
                <input id="pesquisa-input" type="text" class="form-control" placeholder="Pesquisar" aria-label="Pesquisar"
                    aria-describedby="pesquisa">
                <span class="input-group-text" id="pesquisar"><i class="bi bi-search"></i></span>
            </div>
        </div>
    </div>

    <div class="row mt-2 px-sm-4 px-3">
        <table id="respostas"
            class="table table-sm table-hover px-0 table-light table-striped table-bordered table-sm border border-3">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Pergunta</th>
                    <th scope="col">Resposta</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($this->questoes as $key => $questao)
                    @if(isset($this->respostas->where('questao_id', $questao['id'])->first()->resultado ))
                    <tr>
                        <th class="text-start">{{ $key + 1 }}</th>
                        <td class="text-start">{{ $questao['pergunta'] }}</td>
                        <td class="text-end">
                            {{ optional($this->respostas->where('questao_id', $questao['id'])->first())->resultado ?? '' }}
                        </td>

                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
          var pesquisaInput = document.getElementById('pesquisa-input');
          var tabelaExemplo = document.getElementById('respostas');
    
          pesquisaInput.addEventListener('keyup', function() {
            var value = pesquisaInput.value.toLowerCase();
            var rows = tabelaExemplo.getElementsByTagName('tr');
    
            for (var i = 0; i < rows.length; i++) {
              var text = rows[i].textContent.toLowerCase();
    
              if (text.indexOf(value) > -1) {
                rows[i].style.display = '';
              } else {
                rows[i].style.display = 'none';
              }
            }
          });
        });
      </script>
</div>
