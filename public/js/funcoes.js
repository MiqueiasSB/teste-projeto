document.addEventListener('DOMContentLoaded', function () {

   
});


document.addEventListener('livewire:load', function () {
    Livewire.on('marcaOutro', function () {

        var inputOutro = document.querySelector('input[id="Outro"]');
        inputOutro.click();

        setTimeout(function () {
            inputOutro.click();
        }, 100);

    });
});
document.addEventListener('livewire:load', function () {
    Livewire.on('marcaRadios', function (respostaAtual) {
        /*
        if(respostaAtual){
            const radio = document.querySelectorAll('input[type="radio"]');

            var questoes = document.querySelectorAll('.questao');
            var quantQuestoes = questoes.length;
    
            var alternativas = document.querySelectorAll('.alternativa');
            var quantAlternativas = alternativas.length;
    
            let alternativasPorQuestao = quantAlternativas/quantQuestoes;
    
            let cont = 0;
            for(let i_questao=0; i_questao<quantQuestoes; i_questao++){
                for(let i_alternativa = cont; i_alternativa < (alternativasPorQuestao*(i_questao+1)); i_alternativa++){
                    console.log(respostaAtual[i_questao] +" == "+ radio[i_alternativa].id.slice(0, -1));
                    if(respostaAtual[i_questao] == radio[i_alternativa].id.slice(0, -1)){
                        radio[i_alternativa].click();
                    }
                }
                cont += alternativasPorQuestao;
            }
        }
        
*/
    });
});

document.addEventListener('livewire:load', function () {
    Livewire.on('desmarcarRadios', function () {
        const botoes = document.querySelectorAll('.btn-limpar-nivel');

        botoes.forEach(botao => {
            botao.click();
        });
        const radioElements = document.querySelectorAll('input[type="radio"]');
        radioElements.forEach((radio) => {
            radio.checked = false;
        });

    });
});


document.addEventListener('livewire:load', function () {
    Livewire.on('limparBtnAtivo', function () {

        const botoes = document.querySelectorAll('.btn-limpar-nivel');

        botoes.forEach(botao => {
            botao.click();
        });

    });
});

