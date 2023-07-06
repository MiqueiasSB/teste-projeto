<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Questao;

return new class extends Migration
{
    
    public function up(): void
    {
        // ----- ALTERNATIVAS
        // Alternativas só são preenchidas se a questão possuir alternativas especificas
        // ou seja, diferentes das definidas pelo subtopico
        // Se a questão não possuir 'alternativas' definidas então será usada as do 'Subtópico'

        // ----- ORDEM
        // Ordem de perguntas que será mostrada ao usuário 
        // Ordem por subtópico
        // Inicia em 1
        
        $sub_questoes = [
            /*           
                | SUBTOPICO_ID |    
                | ORDEM | PERGUNTA | ALTERNATIVAS | VISIVEL |
            */

            //____________________________________________________
            //################################## Grau de Inovação
            
            1 => [//---- Dimensão Cliente
                [1, 'A empresa identificou novas necessidades dos clientes.'],
                [2, 'A empresa identificou novos mercados para atuação.'],
                [3, 'Foram utilizadas as manifestações de clientes (sugestões e/ou reclamações) para desenvolver novos produtos.'],
                [4, 'Foram lançados produtos decorrentes de necessidades de clientes.'],
                [5, 'Foi aperfeiçoado o relacionamento com os clientes por meio de recursos tecnológicos. '],
                [6, 'A empresa utilizou recursos tecnológicos para se relacionar com os clientes.'],
                [7, 'Foram utilizados recursos existentes para promover a geração de novas receitas na empresa.'],
                [8, 'Foram utilizados relacionamentos com parceiros para geração de novas receitas para empresa. '],
            ],
           
            2 => [//---- Dimensão Oferta
                [1, 'A empresa iniciou a atuação em novos mercados.'],
                [2, 'A empresa lançou novos produtos.'],
                [3, 'A empresa removeu produtos sem sucesso do mercado.'],
                [4, 'Foram realizadas mudanças nas características de produtos/serviços por razões socioambientais.'],
                [5, 'Foram realizadas mudanças significativas no design de produtos.'],
                [6, 'A empresa adotou inovações tecnológicas.'],
                [7, 'A empresa utilizou recursos para famílias de produtos.'],
                [8, 'O mesmo produto é oferecido em diferentes versões para novos mercados consumidores.'],
                [9, 'A empresa ofereceu novas soluções aos clientes.'],
                [10, 'A empresa ofereceu novas soluções aos clientes com base na integração de recursos tecnológicos.'],
            ],
            
            3 => [//---- Dimensão Processos
                [1, 'A empresa aperfeiçoou seus processos.'],
                [2, 'A empresa adotou práticas de gestão.'],
                [3, 'A empresa adotou certificações.'],
                [4, 'A empresa adotou softwares de gestão.'],
                [5, 'Foram aperfeiçoados processos em relação a aspectos socioambientais.'],
                [6, 'A empresa buscou a redução ou utilização de resíduos.'],
                [7, 'Foi feita reorganização ou adoção de novas abordagens para as atividades da empresa.'],
                [8, 'A empresa realizou novas parcerias.'],
                [9, 'Foram adotadas novas formas de trocar informações e ideias com clientes e fornecedores.'],
                [10, 'Foram realizadas mudanças na estratégia competitiva da empresa.'],
                [11, 'A empresa fez aperfeiçoamentos no transporte, distribuição e estoque.'],
            ], 

            4 => [//---- Dimensão Presença
                [1, 'A empresa criou novos pontos ou canais de vendas.'],
                [2, 'Foram estabelecidas novas relações com distribuidores e representantes comerciais.'],
                [3, 'A empresa adotou novas formas de comunicação com os clientes.'],
                [4, 'A empresa realizou o registro de marcas.'],
                [5, 'A empresa utilizou sua marca em diferentes meios no mercado.'],
            ],
            
            //__________________________________________________________________
            //################################ Empreendedorismo Organizacional
            5 => [//---- Dimensão Inovatividade
                [1, 'Em geral, a administração da minha empresa favorece uma forte ênfase em pesquisa e desenvolvimento, liderança tecnológica e inovações.'],
                [2, 'A minha empresa comercializou novas linhas de produtos ou serviços nos últimos 5 anos. '],
                [3, 'As mudanças nas linhas de produtos ou serviços têm gerado impactos nos últimos 5 anos.'],
            ],

            6 => [//---- Dimensão Proatividade
                [1, 'Ao lidar com competidores, minha empresa normalmente inicia ações às quais os competidores tendem a responder. '],
                [2, 'Ao lidar com competidores é muito frequente que a minha empresa seja a primeira a introduzir novos produtos/serviços, técnicas administrativas, tecnologias operacionais, etc.'],
                [3, 'Em geral, a administração de minha empresa tem tendência a antecipar-se à concorrência na introdução de novas ideias ou produtos.'],
            ],
            
            7 => [//---- Dimensão Assunção de riscos
                [1, 'Em geral, a administração da minha empresa tem propensão para projetos de alto risco (com chances de altos retornos).'],
                [2, 'Em geral, a administração da minha empresa acredita que devido à natureza do ambiente, ações amplas e arrojadas são necessárias para atingir os objetivos da empresa.'],
                [3, 'Quando confrontada com a tomada de decisões envolvendo incerteza, a minha empresa normalmente adota uma postura arrojada, agressiva, visando maximizar a probabilidade de explorar oportunidades em potencial.'],
            ],

            8 => [//---- Dimensão Agressividade Competitiva
                [1, 'Minha empresa é muito agressiva e intensamente competitiva.'],
                [2, 'Ao lidar com seus competidores, minha empresa normalmente adota uma postura bastante competitiva, desqualificando os competidores.'],
            ],

            9 => [//---- Dimensão Autonomia
                [1, 'Minha empresa apoia os esforços de indivíduos e/ou times que trabalham de forma autônoma.'],
                [2, 'Em geral, a administração da minha empresa acredita que os melhores resultados acontecem quando indivíduos e/ou times decidem por si próprios que oportunidades de negócios perseguir.'],
                [3, 'Na minha empresa, indivíduos e/ou times em busca de oportunidades de negócio tomam decisões por si próprios sem ter que constantemente consultar seus superiores.'],
                [4, 'Na minha empresa, as iniciativas e proposições dos empregados possuem um papel importante na identificação e seleção das oportunidades de empreendimento que a empresa busca.'],
            ],

            //______________________________________________________________________
            //################################ Maturidade da Transformação Digital
            10 => [//---- Dimensão Experiência do Cliente
                [1, 'A experiência do cliente é consistente em todos os canais comerciais da empresa (digitais e não digitais).'],
                [2, 'É realizada a interação com o cliente por canais digitais e não digitais.'],
                [3, 'O conteúdo digital é desenvolvido de acordo com o comportamento do usuário e dados de CRM existentes.'],
                [4, 'A comunicação digital com o cliente é personalizada.'],
                [5, 'A coleta de dados do cliente e de sua interação é feita a partir de diferentes canais.'],
                [6, 'A empresa possui informações provenientes dos dados de interação com o cliente que influenciam nossa atividade de marketing e comunicação.'],
                [7, 'Os dados dos clientes são analisados e tratados em tempo real.'],
            ],

            11 => [//---- Dimensão Inovação de Produto
                [1, 'Existe o crescimento de serviços e produtos com as ofertas digitais.'],
                [2, 'Implementamos com sucesso novas ideias de negócios digitais ou de modelos de negócios na empresa nos últimos anos.'],
                [3, 'As condições da empresa são adequadas para o desenvolvimento de inovações digitais (por exemplo, metas, recursos financeiros, recursos humanos, liberdade de tempo). '],
                [4, 'Os funcionários contribuem regularmente com ideias para os produtos digitais.'],
                [5, 'Envolvemos ativamente os clientes no desenvolvimento de novas inovações digitais.'],
                [6, 'Os testes realizados por clientes visam a melhoria dos produtos digitais.'],
            ],

            12 => [//---- Dimensão Estratégia
                [1, 'A empresa é considerada como norteadora da inovação digital no setor.  Trocou a afirmação para (Somos percebidos pelos concorrentes e especialistas como um motor de inovações digitais.)'],
                [2, 'A empresa impulsiona projetos digitais com alta prioridade.'],
                [3, 'Avaliamos sistematicamente novas tecnologias e mudanças no comportamento do cliente para identificar potenciais inovações digitais'],
                [4, '“Negócios Digitais" tem um lugar central na nossa estratégia geral.'],
                [5, 'Sabemos quais competências são essenciais para a base do nosso sucesso empresarial em um futuro cada vez mais digital.'],
                [6, 'Impulsionamos sistematicamente e propositalmente inovações digitais.'],
                [7, 'A Transformação digital é vista como projeto de mudança estratégica contínua.'],
            ],
            
            13 => [//---- Dimensão Organização
                [1, 'Existe a criação de produtos digitais em todos os departamentos e funções.'],
                [2, 'A empresa possui a gestão operacional em todos os canais comerciais.'],
                [3, 'A empresa possui um mapeamento para a identificação de novas tecnologias e/ou modelos de negócios relevantes para o negócio.'],
                [4, 'A empresa possui capacidade de rápida reação às mudanças no mercado.'],
                [5, 'A empresa busca inovações digitais simultaneamente às operações comerciais usuais.'],
                [6, 'A empresa possui rede de parceiros para a digitalização.'],
                [7, 'Os procedimentos são eficientes e padronizados na cooperação com parceiros.'],
            ],
        
            14 => [//---- Dimensão Digitalização de processos
                [1, 'Os canais digitais são integrados aos processos de serviços e comunicações.'],
                [2, 'As metas para os canais digitais são determinadas e revisadas.'],
                [3, 'Baseamos nosso planejamento de despesas para comunicação digital sobre a intensidade em que os clientes utilizam a mídia individual.'],
                [4, 'Existe a verificação regular dos principais processos de melhoria na empresa por meio de tecnologias digitais.'],
                [5, 'Exploramos as mais recentes oportunidades digitais para a automatização dos processos de rotina.'],
                [6, 'Os resultados da análise de dados orientam as possíveis ações e decisões estratégicas.'],
                [7, 'A expertise do time de TI em Big Data é empregada no desenvolvimento de novos produtos ou de modelo de negócios.'],
            ],

            15 => [//---- Dimensão Colaboração
                [1, 'O uso de plataformas de colaboração digital (por exemplo, SharePoint, Jive) melhora a troca de informações e a colaboração entre as divisões da nossa empresa.'],
                [2, 'As plataformas de colaboração digital são utilizadas em nossa empresa de forma a reduzir a complexidade e redundâncias na comunicação.'],
                [3, 'Usamos o intercâmbio com especialistas externos para desenvolver conhecimento adicional no campo da digitalização.'],
                [4, 'Nossos colaboradores compartilham conhecimento relevante de forma proativa e estruturada em plataformas de colaboração digital.'],
                [5, 'Nossa infraestrutura móvel com acesso total a dados permite que os funcionários trabalhem e colaborem totalmente em qualquer lugar.'],
                [6, 'Nossa empresa usa especificamente novas formas de trabalho (por exemplo, coworking, escritório móvel) para promover a criatividade e o intercâmbio entre funcionários.'],
            ],

            16 => [//---- Dimensão Tecnologia da Informação
                [1, 'A empresa realiza ajustes à curto prazo nos serviços digitais.'],
                [2, 'A empresa realiza a testagem e modificação de novos produtos com o uso de protótipos.'],
                [3, 'Os sistemas de conexão se conectam rapidamente a outros serviços via interfaces abertas.'],
                [4, 'A empresa realiza a atualização regular na infraestrutura de TI  para atender aos requisitos em constante mudança.'],
                [5, 'O departamento de TI interno assegura as tecnologias digitais pertinentes ao negócio.'],
                [6, 'O departamento interno de TI fornece orientação aos demais departamentos'],
                [7, 'O departamento interno de TI fornece orientação aos demais departamentos de forma proativa e competente.'],
                [8, 'Os funcionários estão cientes de importantes regras de conduta em segurança de TI, e a conformidade com essas regras é verificada regularmente (por exemplo, auditorias externas).'],
                [9, 'Para garantir as operações de TI e a disponibilidade de dados, planejamos e testamos medidas para vários cenários de ameaças.'],
                [10, 'Explicamos de forma proativa e compreensível como os dados são usados pela nossa empresa.'],
            ],

            17 => [//---- Dimensão Cultura e Especialização
                [1, 'A construção de conhecimento digital é componente chave no desenvolvimento dos funcionários.'],
                [2, 'As competências digitais são consideradas um critério importante no processo de recrutamento.'],
                [3, 'Os funcionários estão familiarizados com os produtos digitais.'],
                [4, 'A empresa possui prontidão para assumir riscos nos negócios existentes por meio do uso de soluções digitais inovadoras.'],
                [5, 'A empresa desenvolve a inovação digital mesmo diante dos riscos financeiros.'],
                [6, 'Erros e lições aprendidas de projetos digitais fracassados são comunicados proativamente dentro da empresa.'],
                [7, 'Existe a avaliação de erros na comunicação, produtos/ serviços e processos objetivando a melhoria.'],
            ],
            
            18 => [//---- Dimensão Gestão de Transformação
                [1, 'A transformação digital segue um plano estratégico definido.'],
                [2, 'Existe a definição de papéis, de responsabilidades e de processos para as tomadas de decisões.'],
                [3, 'Os objetivos da transformação digital são definidos de forma mensurável e conhecidos dentro da empresa.'],
                [4, 'A empresa possui revisão periódica dos objetivos de transformação digital.'],
                [5, 'O nível de gestão de topo (direção executiva/conselho de administração/etc.) reconhece a importância dos negócios digitais e disponibiliza os recursos adequados.'],
                [6, 'A gerência intermediária conduz ativamente os processos de mudança na empresa que são necessários para a digitalização.'],
                [7, 'Todos os gestores promovem a responsabilidade pessoal e a vontade de mudança entre os colaboradores no contexto da transformação digital.'],
            ],

            19 => [//---- Dados da Empresa
                [1, 'A empresa em que atua desenvolve algum projeto?'],
                [2, 'A empresa em que atua possui algum projeto em andamento?'],

                [3, 'A empresa utiliza alguma metodologia para gerenciamento de projeto?', json_encode([
                        'Waterfall/Cascata/Tradicional', 
                        'Ágil', 'Híbrida (Tradicional e Ágil)',
                        'Minha Empresa não atua com projetos', 
                        'Não sei responder', 
                        'Outro'
                    ])
                ],

                [4, 'Qual seu gênero?', json_encode([
                        'Feminino', 
                        'Masculino'
                    ])
                ],

                [5, 'Qual seu maior nível de escolaridade:', json_encode([
                        'Ensino Médio', 
                        'Graduação', 
                        'Pós-graduação', 
                        'Mestrado/Doutorado'
                    ])
                ],
                
                [6, 'Faixa Etária:', json_encode([
                        'Até 25 anos', 
                        '26 – 35 anos', 
                        '36 – 45 anos', 
                        '46 – 55 anos', 
                        '56 – 65 anos', 
                        'Acima de 66 anos'
                    ])
                ],

                [7, 'Função:', json_encode([
                        'Função em nível de direção', 
                        'Função em nível de gerência', 
                        'Função em nível técnico', 
                        'Outro', 
                    ])
                ],

                [8, 'A empresa possui membros da equipe de projetos atuando de forma virtual? (home office)?'],

                [9, 'No último ano você se lembra, aproximadamente, quantos novos projetos foram desenvolvidos?', json_encode([
                        'Nenhum', 
                        '1 - 3', 
                        '4 - 6', 
                        '7 ou mais',
                        'Não sei responder' 
                    ])
                ],
                [10, 'Os projetos desenvolvidos estão envolvidos com o produto/serviço final da empresa?'],
                [11, 'Você considera que os projetos são estratégicos para a empresa?'],
                [12, 'Analisando os projetos da empresa, você considera que são a fonte principal de receita no negócio?'],
                [13, 'Os projetos são desenvolvidos por terceiros na empresa?'],
                [14, 'Para gerenciamento dos projetos, a empresa possui uma equipe interna? '],

                [15, 'O principal setor de atuação da empresa é', json_encode([
                        'Indústria', 
                        'Comércio', 
                        'Serviço', 
                        'Terceiro setor', 
                    ])
                ],
                [16, 'Qual o segmento de atuação da sua empresa?', json_encode([
                        'Alimentação', 
                        'Educacional', 
                        'Energia', 
                        'Farmacêutico',
                        'Financeiro',
                        'Indústria da construção',
                        'Indústria digital',
                        'Químico e petroquímico',
                        'Saúde',
                        'Serviços',
                        'Siderurgia e metalurgia',
                        'Tecnologia da Informação',
                        'Telecomunicações',
                        'Têxtil',
                        'Transporte',
                        'Varejo',
                        'Outro'
                    ])
                ],
                [17, 'O faturamento anual está em qual faixa média:', json_encode([
                        'Menor ou igual a R$ 2,4 milhões', 
                        'Maior que R$ 2,4 milhões e menor ou igual a R$ 16 milhões', 
                        'Maior que R$ 16 milhões e menor ou igual a R$ 90 milhões', 
                        'Maior que R$ 90 milhões e menor ou igual a R$ 300 milhões', 
                        'Maior que R$ 300 milhões'
                    ])
                ],
                [18, 'Qual o número aproximado de Colaboradores?', json_encode([
                        'Até 30 colaboradores', 
                        'De 31 a 100 colaboradores', 
                        'De 101 a 300 colaboradores', 
                        'De 301 até 500 colaboradores', 
                        'Acima de 501 colaboradores'
                    ])
                ],
            ]

        ];

        foreach ($sub_questoes as $key_sub => $sub_questao) {

            foreach ($sub_questao as $questao) {
                Questao::create([
                    'subtopico_id' => $key_sub,
                    'ordem' => $questao[0],
                    'pergunta' => $questao[1],
                    'alternativas' => isset($questao[2]) ? $questao[2] : '',
                    'visivel' => isset($questao[3]) ? $questao[3] : true,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]);
            }
           
        }

        /*
            -- ORDEM -- 
            ______________________________________________________________________________________________________
            Como o a resposta vai estar vinculada ao id da questão 
            eu não posso utilizar o id da questão como a ordem á ser mostrada no formulário
            pois se eu precisar mudar a ordem eu teria que modificar o id, oq alternaria as perguntas das resposta anteriores
            ________________________________________________________________________________________________
            Por mais que inicialmente a definição da 'ordem' seja igual ao 'id' (pois já coloquei na ordem inicial definida pelo cliente),
            é necessário que sejam dois indices diferente pois se precisar mudar a ordem das questões apenas altero o indice 'ordem'


        */ 

        /*
            -- Adicionar ou Remover questões -- 
            ______________________________________________________________________________________________________
            Adicione a nova questão no final do array de cada subtópico
            ________________________________________________________________________________________________
            Remover mas marter anteriores
                - Mantenho a ordem da pergunta e modifico apenas sua visibilidade para false
                - Não vai aparecer mais no formulário 
                - Vai aparecer ainda nos formularios das empresas que já responderam e contar nos gráficos

            Remover permanentemente
                - Apagará a pergunta e todas as respostas relacionadas
                - no cruzamento de dados vai constar que não exite e vai tirar a média dos restantes


        */ 
    }

    public function down(): void
    {
         // Remova os registros inseridos na migração
         Questao::truncate();
    }
};
