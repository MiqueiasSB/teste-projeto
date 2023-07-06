<div class="progress position-fixed top-0 start-0 w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100">
    <div class="progress-bar bg-{{$cor}} " role="progressbar" style="width: {{    ($this->posicao*100)/$this->quantidadeTopico - ($this->voltar*100)/$this->quantidadeTopico }}%; " aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>

    <div class="progress-bar bg-{{$cor}} opacity-50 text-dark" style="width: {{    ($this->voltar*100)/$this->quantidadeTopico  }}%; "></div>

</div>
 
{{--
    Valor em porcentagem (x) é igal á:

        Quantidade Total    - 100 %
        Posição             -  x %

        x = (posição . 100)/Quantidade
    ___________________________________
    Exemplo:
        Quantidade = 10
        Posição = 5

        x = (5 . 100)/10
        x = 500/10
        x = 50%

--}}