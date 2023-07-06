<div class="row justify-content-center mt-2" style=" page-break-before: always;">
    <div class="mb-3 mt-2">
        <x-recomendacoes.subtitulo>Recomendações</x-recomendacoes.subtitulo>

    </div>


    <div class="accordion p-0" id="recomendacoes">
        @php
            $contFinal = 0;
        @endphp

        @foreach ($this->textoRecomendacoes as $id_topico => $topico)
            @foreach ($topico as $id_recomendacao => $recomendacao)
                @php
                    $this->status = false;
                @endphp

                {{-- Para pular o indece Inovação e Cliente do topico Estrategia --}}
                @if (!($id_topico == 2 && ($id_recomendacao == 0 || $id_recomendacao == 1)))
                    @if ($this->menorMedia[$id_topico] <= 3 && $this->relacionamentos[$id_topico][$id_recomendacao] <= 3)
                        @php
                            $this->status = true;
                        @endphp
                    @elseif (
                        $this->menorMedia[$id_topico] > 3 &&
                            $this->menorMedia[$id_topico] <= 4 &&
                            $this->relacionamentos[$id_topico][$id_recomendacao] > 3 &&
                            $this->relacionamentos[$id_topico][$id_recomendacao] <= 4)
                        @php
                            $this->status = true;
                        @endphp
                    @elseif (
                        $this->menorMedia[$id_topico] > 4 &&
                            $this->menorMedia[$id_topico] < 4.7 &&
                            $this->relacionamentos[$id_topico][$id_recomendacao] > 4 &&
                            $this->relacionamentos[$id_topico][$id_recomendacao] < 4.7)
                        @php
                            $this->status = true;
                        @endphp
                    @elseif ($this->menorMedia[$id_topico] >= 4.7 && $this->relacionamentos[$id_topico][$id_recomendacao] >= 4.7)
                        @php
                            $contFinal++;
                        @endphp
                    @endif
                @endif

                @if ($this->status)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button bg-secondary" type="button" data-bs-toggle="collapse"
                                data-bs-target="#titulo_{{ $id_recomendacao . '-' . $id_topico }}" aria-expanded="true"
                                aria-controls="titulo_{{ $id_recomendacao . '-' . $id_topico }}">
                                <h3 class="mb-0">{{ $recomendacao['subtopico'] }}</h3>
                            </button>
                        </h2>
                        <div id="titulo_{{ $id_recomendacao . '-' . $id_topico }}"
                            class="accordion-collapse collapse show">
                            <div class="accordion-body">
                                <ol>
                                    @foreach ($recomendacao['texto'] as $texto)
                                        <li> {{ $texto }}</li>
                                    @endforeach
                                </ol>

                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endforeach

        @if ($contFinal == 16)
            <div class="text-center ">
                <h2>
                    Agradecemos a realização do diagnóstico de sua empresa sobre Empreendedorismo, Inovação e
                    Transformação Digital.
                </h2><br>
                <h5>Sua empresa está no caminho certo rumo à disrupção do mercado. A análise revela que as práticas
                    realizadas são assertivas para o desenvolvimento conjunto de práticas relacionadas ao
                    empreendedorismo, a inovação e a transformação digital.</h5>
                    <div class="mt-5">
                        <span class="text-primary py-5 h4"><b>-- Parabéns! --</b></span>
                    </div>
                
            
            </div>
        @endif
    </div>
</div>
