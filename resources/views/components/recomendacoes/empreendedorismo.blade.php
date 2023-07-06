<div>
    @if ($this->mediaGeral < 3)
        <x-recomendacoes.subtitulo>Empresa com baixa Orientação Empreendedora</x-recomendacoes.subtitulo>
    
    @elseif($this->mediaGeral >= 3 && $this->mediaGeral < 4)
        <x-recomendacoes.subtitulo>Empresa com média Orientação Empreendedora</x-recomendacoes.subtitulo>
       
    @elseif($this->mediaGeral > 4 && $this->mediaGeral < 5)
        <x-recomendacoes.subtitulo>Empresa com alta Orientação Empreendedora</x-recomendacoes.subtitulo>
       
    @elseif($this->mediaGeral == 5)
        <x-recomendacoes.subtitulo>Parabéns!</x-recomendacoes.subtitulo>
    @endif
</div>
