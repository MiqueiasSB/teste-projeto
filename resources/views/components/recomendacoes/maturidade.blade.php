<div>
    @if ($this->medias[0] <= 3) 

            <x-recomendacoes.subtitulo> 
       
                <b>Promover e Apoiar</b> <br>
                <h4>Sua empresa está no Estágio 1</h4>
    
                <h6>    Indica que a empresa está no estágio inicial de desenvolvimento de práticas para a
                    Transformação Digital.
                </h6>
               
            </x-recomendacoes.subtitulo>

      
    @elseif($this->medias[1] <= 3)
        <x-recomendacoes.subtitulo> 
       
            <b>Criar e Construir</b> <br>
            <h4>Sua empresa está no Estágio 2</h4>

            <h6>Indica a promoção de questões digitais e a inserção de novas tecnologias na operação da
                empresa.
            </h6>
           
        </x-recomendacoes.subtitulo>

       
    @elseif($this->medias[2] <= 3)

    <x-recomendacoes.subtitulo> 
       
        <b>Compromisso com a Transformação Digital</b> <br>
        <h4>Sua empresa está no Estágio 3</h4>

        <h6>Indica que a empresa desenvolve a cultura digital com o
            gerenciamento proativo do aprendizado, indicando capacidade de reação às mudanças nas estruturas
            organizacionais.
        </h6>
       
    </x-recomendacoes.subtitulo>

      
    @elseif($this->medias[3] <= 3)
        <x-recomendacoes.subtitulo> 
        
            <b>Processos Centrados no Usuário</b> <br>
            <h4>Sua empresa está no Estágio 4</h4>

            <h6>Significa que possui o envolvimento dos colaboradores nos processos de
                inovação e que dá foco na personalização das experiências do cliente e na interação.
            </h6>
        
        </x-recomendacoes.subtitulo>

       
    @elseif($this->medias[4] <= 3)
        <x-recomendacoes.subtitulo> 
            
            <b>Empresa Orientada a Dados</b> <br>
            <h4>Sua empresa está no Estágio 5</h4>

            <h6>Significa que se utilizam métricas relacionadas ao uso de tecnologias e de
                análise de dados para o planejamento estratégico.
            </h6>
        
        </x-recomendacoes.subtitulo>
    @endif
</div>
