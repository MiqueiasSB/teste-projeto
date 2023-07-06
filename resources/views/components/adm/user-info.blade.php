<div
    class="row mb-2 py-3 align-items-center justify-content-center bg-primary-light border border-4 border-primary-active rounded">

    <div class="row justify-content-between align-items-center ">

        <div class="col-sm-6 col-12 text-sm-start text-center">
            <h3 class="m-0">{{ $this->empresa->name }}</h3>
            <span>{{ $this->empresa->email }}</span>
            <span>{{ !empty($this->empresa->cnpj) ? ' - '.$this->empresa->cnpj : ' ' }}</span>
        </div>

        <div class="col-sm-6 col-12 mt-sm-0 mt-4  text-end d-print-none">
            <div class="btn-group w-100" role="group" aria-label="Basic example" x-data="{ print: function() { window.print(); } }">

                <button @click="print()" class="btn btn-secondary"><span class="d-sm-inline d-none">Imprimir</span>
                    <i class="bi bi-printer"></i>
                </button>

                <button class="btn btn-success" onclick="exportarParaExcel('respostas','respostas')">
                    <span class="d-sm-inline d-none">Planilha</span>
                    <i class="bi bi-file-earmark-spreadsheet"></i>
                </button>

                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletar">
                    <span class="d-sm-inline d-none">Excluir</span>
                    <i class="bi bi-trash"></i>
                </button>
            </div>

            <!-- Modal Excluir -->
            <div class="modal fade" id="deletar" tabindex="-1" aria-labelledby="filtroLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="fs-5 text-danger">
                                <i class="bi bi-trash"></i> 
                                Empresa:
                                {{ $this->empresa->name }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body fs-2 text-start">
                            Excluir todos os dados desta empresa?
                        </div>
                        <div class="modal-footer">
                            <button data-bs-dismiss="modal"
                            class="btn btn-secondary">Não
                            </button>
                            <button wire:click="deletUser()"
                                class="btn btn-danger">Excluir
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="row">

    </div>
</div>


<script>
    function exportarParaExcel(id_table, nome) {
        nome = nome.replace(/\s/g, "-");
        console.log(id_table, nome);

        const tabela = document.getElementById(id_table);
        const nomeArquivo = nome + '.xlsx';

        const wb = XLSX.utils.table_to_book(tabela, {
            sheet: 'Sheet JS'
        });
        XLSX.writeFile(wb, nomeArquivo);
    }
</script>
