<div class="row mb-2 px-sm-2 pt-2 pb-0 align-items-center justify-content-center bg-{{ $this->cor1 }}-light border border-4 border-{{ $this->cor1 }}-active rounded">

    <div class="row justify-content-between align-items-center">

        <div class=" col-6">
            @if($this->titulo == "Resultado Final")
                <h4 class="m-0">Dados</h4>
            @else
                <h4 class="m-0">Resultado Parcial</h4>
            @endif
        </div>
        
        <div class=" col-6 text-end d-print-none">
            <div class="btn-group" role="group" aria-label="Basic example" x-data="{ print: function() { window.print(); } }">   
                <button @click="print()" class="btn btn-{{ $this->cor2 }}"><span class="d-sm-inline d-none">Imprimir</span> 
                    <i class="bi bi-printer"></i></button>
                <button class="btn btn-success" onclick="exportarParaExcel('medias','EITD{{ $this->titulo }}')">
                    <span class="d-sm-inline d-none">Planilha</span> 
                    <i class="bi bi-file-earmark-spreadsheet"></i></button>
            </div>
        </div>
         
    </div>
    
    <div class="row mt-2 px-sm-4 px-3">
        <table id="medias" class="table px-0 table-light table-striped table-bordered table-sm border border-3">
            <tbody>
                @foreach ($this->medias as $key => $media)
                    <tr>
                        <th class="text-start">{{ $this->titulosSub[$key]}}</th>
                        <td class="text-center">{{ $media }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    
<script>
    function exportarParaExcel(id_table, nome) {
        
        
        nome = nome.replace(/\s/g, "-");
        console.log(id_table, nome);
        
        const tabela = document.getElementById(id_table);
        const nomeArquivo = nome+'.xlsx';

        const wb = XLSX.utils.table_to_book(tabela, { sheet: 'Sheet JS' });
        XLSX.writeFile(wb, nomeArquivo);
    }
</script>
    
</div>

