<?php

namespace App\Http\Livewire;

use App\Models\Questao;
use App\Models\Resposta;
use App\Models\Subtopico;
use App\Models\Topico;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class ResultadoFinal extends Component {

    public $usuario;

    public $medias = [];
    public $mediasSub = [];
    public $relacionamentos = [];
    public $recomendacoesSub = []; //Guarda o [id topico(0-2)][id referente ao subtopico do relacionamento] 
    public $textoRecomendacoes = [];
    public $titulosSub = [];
    public $status = false;

    public $menorMedia = [];
    public $limites = [];
    public $respostas;

    public $titulo;
    public $cor1;
    public $cor2;

    public function mount() {
        $this->usuario = Auth::user();
        $this->titulo = "Resultado Final";
        $this->titulosSub = ["Dimensão Cliente", "Dimensão Inovação", "Dimensão Estratégia"];

        $this->verificaDados();

        $this->verificaRecomendacoes();
    }

    public function verificaDados() {

        $this->recuperaMedias();

        $this->relacionamentos();

        $this->medias = [
            number_format(array_sum($this->relacionamentos[0])  /  count($this->relacionamentos[0]), 2, '.', ''),
            number_format(array_sum($this->relacionamentos[1])  /  count($this->relacionamentos[1]), 2, '.', ''),
            number_format(array_sum($this->relacionamentos[2])  /  count($this->relacionamentos[2]), 2, '.', ''),
        ];

        $this->textoRecomendacoes = [
            [ //Cliente
                [
                    'subtopico' => 'Ofertas',
                    'texto' => [
                        1 => "Lançar novos produtos ou serviços da empresa para o mercado.",
                        2 => "Criar produtos e serviços que sejam valorizados pelos clientes como, por exemplo, a criação de um conjunto diversificado de ofertas utilizando diversos canais (físicos e digitais).",
                        3 => "Criar um conjunto diversificado de ofertas utilizando diversos canais (físicos e digitais).",
                        4 => "Iniciar atuação em novos mercados.",
                        5 => "Utilizar novas plataformas para o desenvolvimento de um produto ou serviço.",
                        6 => "Identificar demandas não atendidas de clientes ou segmentos de clientes.",
                        7 => "Desenvolver novos sistemas de preços e propor soluções na cadeia de suprimentos.",
                        8 => "Redefinir as responsabilidades dos colaboradores e incentivos à inovação de produtos, serviços e processos.",
                        9 => "Descobrir fluxos de receita inexplorados.",
                        10 => "Desenvolver novos sistemas de preços e pontos de vendas e/ou locais para utilização do produto ou serviço pelos clientes."
                    ]
                ],
                [
                    'subtopico' => 'Cliente',
                    'texto' => [
                        1 => "Personalizar produtos ou serviços.",
                        2 => "Propor opções complementares ou adicionais que atendam às necessidades especificas de seus clientes.",
                        3 => "Reavaliar e/ou redesenhar pontos de contato a fim de estreitar a interação com o cliente.",
                        4 => "Desenvolver meios de manter o relacionamento com seus clientes.",
                        5 => "Explorar novas fontes de receitas, propor novas interações com cliente e parceiros.",
                        6 => "Criação, operação e melhoria dos canais para uma estratégia múltiplos pontos de contato com o cliente."
                    ]
                ],
                [
                    'subtopico' => 'Proatividade',
                    'texto' => [
                        1 => "Introduzir no mercado novos produtos/serviços.",
                        2 => "Iniciar em um novo mercado emergente.",
                        3 => "Estimular a flexibilidade tecnológica.",
                        4 => "Realizar o monitoramento do ambiente com relação aos clientes e concorrentes em busca de oportunidades.",
                        5 => "Desenvolver o planejamento orientado para a solução de problemas e a busca de oportunidades."
                    ]
                ],
                [
                    'subtopico' => 'Assunção de Risco',
                    'texto' => [
                        1 => "Criar valor nos mercados em que os clientes exigem mudanças constantes.",
                        2 => "Assumir riscos para possível obtenção de melhores retornos financeiros.",
                        3 => "Identificar e aproveitar oportunidades não testadas pelo mercado.",
                        4 => "Ter decisões ousadas em prol dos objetivos da empresa.",
                        5 => "Assumir uma postura agressiva em decisões que tenham risco financeiro para empresa.",
                        6 => "Redefinir a postura estratégica do negócio para explorar o potencial de demandas emergentes no mercado."
                    ]
                ],
                [
                    'subtopico' => 'Experiência do Cliente',
                    'texto' => [
                        1 => "Avaliar os canais de comunicação e a experiência do cliente.",
                        2 => "Priorizar a disponibilização de tecnologias digitais e de infraestrutura atualizada para toda a equipe.",
                        3 => "Reavaliar e/ou redesenhar pontos de contato a fim de estreitar a interação com cliente.",
                        4 => "Digitalizar os pontos de contato com o cliente.",
                        5 => "Criação, operação e melhoria dos canais para uma estratégia de múltiplos canais de contato com o cliente.",
                        6 => "Gerar benefício para o cliente com a digitalização.",
                        7 => "Personalizar produtos/serviços.",
                        8 => "Utilizar serviços digitais para envolver os clientes, criando valor a partir de dados.",
                        9 => "Criar valor ao cliente a partir de dados.",
                        10 => "Incluir benefício para o cliente com a digitalização, por exemplo, a personalização de produtos/serviços."
                    ]
                ],
                [
                    'subtopico' => 'Tecnologia da Informação',
                    'texto' => [
                        1 => "Desenvolver a agilidade na gestão de projetos.",
                        2 => "Adoção de novos sistemas de TI baseados em digitalização, em agilidade de sistemas de suporte e em processamento digital de dados.",
                        3 => "Desenvolver a prontidão digital, ou seja, habilitar a empresa para reação rápida a mudanças quando necessárias.",
                        4 => "Desenvolver a segurança digital.",
                        5 => "Desenvolver soluções integradas de clientes em toda a cadeia de suprimentos, portfólio de produtos/serviços digitais. Ter arquitetura/sistemas baseada em digitalização, agilidade no suporte aos sistemas e em processamento digital dos dados."
                    ]
                ],


            ],
            [ //Inovação
                [
                    'subtopico' => 'Processos',
                    'texto' => [
                        1 => "Redesenhar os processos visando melhorar eficiência.",
                        2 => "Reorganizar funções e tarefas para atender às demandas de mercado.",
                        3 => "Aperfeiçoar os processos da cadeia de suprimentos.",
                        4 => "Promover medidas que melhorem o fluxo de informações.",
                        5 => "Explorar áreas como novos sistemas de produção, sistemas de prestação de serviços e processos organizacionais."
                    ]
                ],
                [
                    'subtopico' => 'Proatividade',
                    'texto' => [
                        "Introduzir no mercado novos produtos/serviços.",
                        "Iniciar em um novo mercado emergente.",
                        "Estimular a flexibilidade tecnológica.",
                        "Realizar o monitoramento do ambiente com relação aos clientes e concorrentes em busca de oportunidades.",
                        "Desenvolver o planejamento orientado para a solução de problemas e a busca de oportunidades."
                    ]
                ],
                [
                    'subtopico' => 'Assunção de Risco',
                    'texto' => [
                        "Criar valor nos mercados em que os clientes exigem mudanças constantes.",
                        "Assumir riscos para possível obtenção de melhores retornos financeiros.",
                        "Identificar e aproveitar oportunidades não testadas pelo mercado.",
                        "Ter decisões ousadas em prol dos objetivos da empresa.",
                        "Assumir uma postura agressiva em decisões que tenham risco financeiro para empresa.",
                        "Redefinir a postura estratégica do negócio para explorar o potencial de demandas emergentes no mercado."
                    ]
                ],
                [
                    'subtopico' => 'Inovatividade',
                    'texto' => [
                        "Incentivar a mudança de ações na gestão visando ao aumento no engajamento dos colaboradores para desenvolvimento de ideias e práticas para o desenvolvimento da criatividade.",
                        "Realizar parcerias com instituições que promovam a inovação",
                        "Engajar e a apoiar novas ideias, novidades, experimentos e processos criativos, que possam resultar em novos produtos, serviços ou processos",
                        "Encontrar novas oportunidades de mercado por meio da experimentação, do desenvolvimento, da imitação e adoção de novas técnicas organizacionais.",
                        "Realizar lançamentos de produtos/serviços com amplitude global.",
                        "Revisar o modelo de negócios para incorporar recursos humanos e físicos, novas tecnologias, P&D, melhorias na proposta de valor ao cliente",
                        "Desenvolver a mentalidade de inovação nos colaboradores.",
                        "Realizar mudanças em produtos/serviços baseadas nas alterações de comportamento dos clientes.",
                        "Incentivar a mudança de ações na gestão visando ao aumento no engajamento dos colaboradores para desenvolvimento de ideias e práticas para o desenvolvimento da criatividade."
                    ]
                ],
                [
                    'subtopico' => 'Digitalização de Produtos',
                    'texto' => [
                        1 => "Desenvolver campanhas digitais de marketing digital.",
                        2 => "Implantar tecnologias para o tratamento de dados.",
                        3 => "Apoiar as iniciativas para digitalização.",
                        4 => "Revisar os processos considerando melhorias por tecnologias digitais.",
                        5 => "Digitalização e automação de processos.",
                        6 => "Tornar flexível e ágil os processos, conscientizar os colaboradores sobre a necessidade da digitalização, bem como apoiar as iniciativas iniciais nesse campo e revisar os processos considerando melhorias por tecnologias digitais."
                    ]
                ],
                [
                    'subtopico' => 'Inovação de Produto',
                    'texto' => [
                        1 => "Expandir a área de negócios.",
                        2 => "Realizar a integração de novos produtos e serviços com o cliente.",
                        3 => "Desenvolver novos produtos e serviços.",
                        4 => "Digitalizar ofertas de produtos/serviços.",
                        5 => "Realizar análise de dados para individualização de produtos/serviços.",
                        6 => "Desenvolver serviços baseados em dados e em recursos digitais."
                    ]
                ],


            ],
            [ //Estratégia
                [
                    'subtopico' => 'Inovação',
                    'texto' => []
                ],
                [
                    'subtopico' => 'Cliente',
                    'texto' => []
                ],
                [
                    'subtopico' => 'Estratégia',
                    'texto' => [
                        1 => "Desenvolver o comprometimento organizacional com aspectos digitais.",
                        2 => "Desenvolver uma cultura organizacional que apoie a Transformação Digital.",
                        3 => "Realizar parcerias com empresas de tecnologias.",
                        4 => "Desenvolver estratégia de negócios digitais, alinhando os negócios e as mudanças do mercado.",
                        5 => "Fornecer aos clientes uma proposta de valor única.",
                        6 => "Permitir novos modelos de negócios e novas formas de organização.",
                        7 => "Construir barreiras à entrada de players no mercado.",
                        8 => "Expandir a atuação geográfica ou de mercado.",
                        9 => "Desenvolvimento/execução de uma estratégia, utilizando tecnologia digital para fazer negócios de maneiras fundamentalmente novas, ousadas e com orientação de longo prazo, vinculada à estratégia de negócios.",
                        10 => "Desenvolver a tolerância ao risco e às falhas, devendo se manter aberta/disposta a mudar formas de trabalho e ter capacidade de mudança para se reinventar constantemente.",
                        11 => "Desenvolver a tolerância ao risco e às falhas, devendo se manter aberta/disposta a mudar formas de trabalho e ter capacidade de mudança para se reinventar constantemente. Isso gera o aprendizado organizacional contínuo com agilidade e flexibilidade."

                    ]
                ],
                [
                    'subtopico' => 'Cultura e Especialização',
                    'texto' => [
                        1 => "Desenvolver a afinidade digital.",
                        2 => "Estabelecer, desenvolver e implantar a cultura para assunção aos riscos e de não atribuição de culpa por erros.",
                        3 => "Realizar a flexibilização do trabalho.",
                        4 => "Incluir os gestores e colaboradores como partes ativas da transformação digital na empresa.",
                        5 => "Desenvolver a comunicação interna, fornecendo informações específicas aos colaboradores sobre a transformação digital.",
                        6 => "Desenvolver habilidades digitais, expertise, experiência e interesse pessoal de tecnologias nos funcionários.",
                        7 => "Desenvolver a habilidade para tomada de decisões com base em dados.",
                        8 => "Utilizar métodos ágeis."
                    ]
                ],
            ],
        ];
    }
    public function recuperaMedias() {
        $subIds = [
            [2, 3, 4], //Grau de Inovação
            [6, 7, 8], //Empreendedorismo
            [11, 17, 15, 12, 13, 18] //Maturidade
        ];

        for ($i = 0; $i < 3; $i++) { //Percorre os topicos
            foreach ($subIds[$i] as $key => $id) { //Percorre os subtopicos

                $resultados = Resposta::where('user_id', $this->usuario->id)
                    ->whereHas('questao', function ($query) use ($id) {
                        $query->where('subtopico_id', $id);
                    })
                    ->pluck('resultado');

                $somaResultados = 0;

                foreach ($resultados as $resultado) { //Percorre as respostas dos subtopicos

                    if ($i == 0) { //Inovação
                        switch ($resultado) {
                            case 'Baixo':
                                $somaResultados += 1;
                                break;
                            case 'Médio':
                                $somaResultados += 3;
                                break;
                            case 'Alto':
                                $somaResultados += 5;
                                break;
                        }
                    }
                    if ($i == 1) { //Empreendedorismo

                        switch ($resultado) {
                            case 'Concordo totalmente':
                                $somaResultados += 5;
                                break;
                            case 'Concordo':
                                $somaResultados += 4;
                                break;
                            case 'Não concordo/nem discordo':
                                $somaResultados += 3;
                                break;
                            case 'Discordo':
                                $somaResultados += 2;
                                break;
                            case 'Discordo totalmente':
                                $somaResultados += 1;
                                break;
                        }
                    }
                    if ($i == 2) { //Maturidade
                        switch ($resultado) {
                            case 'Concordo totalmente':
                                $somaResultados += 4;
                                break;
                            case 'Concordo':
                                $somaResultados += 3;
                                break;
                            case 'Não concordo/nem discordo':
                                $somaResultados += 2;
                                break;
                            case 'Discordo':
                                $somaResultados += 1;
                                break;
                            case 'Discordo totalmente':
                                $somaResultados += 0;
                                break;
                            case 'Não sei(desconheço)':
                                $somaResultados += 0;
                                break;
                        }
                    }
                }
                $this->mediasSub[$i][$key] = number_format($somaResultados /  $resultados->count(), 2, '.', '');
            }
        }
    }

    public function relacionamentos() {
        /*  $this->mediasSub =  [
            [2, 3, 4], //Grau de Inovação - 0
            [6, 7, 8], //Empreendedorismo - 1
            [11, 17, 15, 12, 13, 18] //Maturidade - 2
        ];*/

        //[Topico][Indice do Id do subtopico]

        $this->relacionamentos =  [
            [ //Cliente
                $this->mediasSub[0][0], //Oferta
                $this->mediasSub[0][1], //Cliente
                $this->mediasSub[1][0], //Proatividade
                $this->mediasSub[1][1],
                $this->mediasSub[2][0],
                $this->mediasSub[2][1],

            ],
            [ //Inovação
                $this->mediasSub[0][2],
                $this->mediasSub[1][0],
                $this->mediasSub[1][1],
                $this->mediasSub[1][2],
                $this->mediasSub[2][2],
                $this->mediasSub[2][3],
            ]
        ];

        $this->relacionamentos[] = [ //Estrategia

            number_format(array_sum($this->relacionamentos[0])  /  count($this->relacionamentos[0]), 2, '.', ''),
            number_format(array_sum($this->relacionamentos[1])  /  count($this->relacionamentos[1]), 2, '.', ''),
            $this->mediasSub[2][4],
            $this->mediasSub[2][5],
        ];
    }
    public function verificaRecomendacoes() {
        ///relacionamentos possui a média de cada um dos subtópicos por topico
        foreach ($this->relacionamentos as $key => $topico) {
            //Recupera a menor média de cada tópico
            $this->menorMedia[$key] = min(array_map('floatval', $topico));
        }
    }



    public function render() {
        return view('livewire.resultado-final');
    }
}
