<div>
    @foreach ($lista as $index => $item)
        <div class="d-flex align-items-start rounded p-2 my-1 fs-5">

            <i class="bi bi-circle-fill text-{{ $this->cor2 }} me-3"></i>

            <div class="flex-column ml-2">
                <p class="mb-0">
                    @if ($item == 'LINK')
                        <span>Esclarecimentos ou Dúvidas, por favor, entre em contato clicando
                            <a target="_blank" href="https://linktr.ee/debora3m">aqui</a>.
                        </span>
                    @else
                        {{ $item }}
                    @endif
                </p>
            </div>
        </div>
    @endforeach
</div>
