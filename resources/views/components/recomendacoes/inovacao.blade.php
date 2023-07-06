<div class="row justify-content-center px-0">
    @if ($this->mediaGeral < 3)
        <x-recomendacoes.subtitulo>Empresa pouco inovadora</x-recomendacoes.subtitulo>
 
       
    @elseif($this->mediaGeral >= 3 && $this->mediaGeral < 4)
        <x-recomendacoes.subtitulo>Empresa inovadora ocasional</x-recomendacoes.subtitulo>

        
    @elseif($this->mediaGeral > 4 && $this->mediaGeral < 5)
        <x-recomendacoes.subtitulo>Empresa inovadora sistêmica. Parabéns!</x-recomendacoes.subtitulo>

      
    @elseif($this->mediaGeral == 5)
        <x-recomendacoes.subtitulo>Parabéns!</x-recomendacoes.subtitulo>
        
    @endif
</div>
