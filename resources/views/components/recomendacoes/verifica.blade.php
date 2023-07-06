<div class="row justify-content-center mb-2">

    @if ($this->topico->id == 2)
        <x-recomendacoes.inovacao></x-recomendacoes.inovacao>
    @elseif($this->topico->id == 3)
        <x-recomendacoes.empreendedorismo></x-recomendacoes.empreendedorismo>
    @elseif($this->topico->id == 4)
        <x-recomendacoes.maturidade></x-recomendacoes.maturidade>
    @endif
  
</div>
