<div class="w-100">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-secondary w-100" data-bs-toggle="modal" data-bs-target="#filtro">
        <i class="bi bi-funnel-fill"></i>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="filtro" tabindex="-1" aria-labelledby="filtroLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"">
            <div class="modal-content" 
            x-data="{ 
                dados: {
                    status : '{{ $this->filtros['status'] }}',
                    metodologia: {{ json_encode($this->filtros['metodologia']) }}

                } 
            }">
            
                <h1 x-text="dados.metodologia"></h1>
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="filtroLabel"><i class="bi bi-funnel-fill"></i> Filtros</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" >
                    <form wire:submit.prevent="submitFiltros" id="submitFiltros">
                        <div class="row px-4 mb-2">
                            <h4 class="row ps-0">Status</h4>
                            <hr class="row">

                            <div class="form-check">
                                <input class="form-check-input" type="radio" x-model="dados.status"
                                   name="status" value="Todos" id="todos" checked>
                                <label class="form-check-label" for="todos">
                                    Todos
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" x-model="dados.status"
                                name="status" value="Finalizados" id="finalizados">
                                <label class="form-check-label" for="finalizados">
                                    Finalizados
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" x-model="dados.status"
                                name="status" value="Andamento" id="andamento">
                                <label class="form-check-label" for="andamento">
                                    Em Andamento
                                </label>
                            </div>
                        </div>

                        <div class="row px-4">
                            <h4 class="row ps-0">Metodologia</h4>
                            <hr class="row">

                            @foreach (['Preditiva (waterfall/cascata/tradicional)',
                                    'Iterativa (ágil)',
                                    'Híbrida (Preditiva e Iterativa)', 
                                    'Não sei responder', 
                                    'Outro'] as $key => $metodologia)
                                    
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" x-model="dados.metodologia"
                                        value="{{ $metodologia }}" id="{{ $key }}">
                                        <label class="form-check-label" for="{{ $key }}">
                                            {{ $metodologia }}
                                        </label>
                                    </div>
                                
                            @endforeach

                        </div>
                    </form>


                </div>
                <div class="modal-footer">
                    <button type="submit" data-bs-dismiss="modal" x-on:click="$wire.aplicaFiltros(dados)" class="btn btn-secondary">Aplicar</button>
                </div>
            </div>
        </div>
    </div>
</div>
