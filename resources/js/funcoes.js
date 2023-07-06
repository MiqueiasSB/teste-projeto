document.addEventListener('DOMContentLoaded', function () {});

function marcaOutro() {

}
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
    Livewire.on('desmarcarRadios', function () {

        const radioElements = document.querySelectorAll('input[type="radio"]');
        radioElements.forEach((radio) => {
            radio.checked = false;
        });

    });
});
