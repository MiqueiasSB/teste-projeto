<div class=" row justify-content-end my-3 d-print-none">

    <div class="col-md-2 col-sm-4  p-0">

        @if (isset($this->topico))
        @if ($this->topico->id == 2)
            <a class="btn w-100 px-4 py-3 btn-primary" href="/empreendedorismo-organizacional"><i class="bi bi-check-lg"></i>
                Próxima Etapa </a>
        @elseif ($this->topico->id == 3)
            <a class="btn w-100 px-4 py-3 btn-primary" href="/maturidade-da-transformacao-digital"><i class="bi bi-check-lg"></i>
                Próxima Etapa </a>
        @elseif ($this->topico->id == 4)
            <a class="btn w-100 px-4 py-3 btn-primary" href="/resultado-final"><i class="bi bi-check-lg"></i>
                Resultado Final </a>
        @endif
    @else
        <a class="btn w-100 px-4 py-3 btn-primary" href="/agradecimento"><i class="bi bi-check-lg"></i>
            Finalizar </a>
    @endif

    </div>
  

</div>
