// "Numero Tarjeta" input and label variables
let inputTarjeta = document.getElementById('tarjeta');
const pTarjeta = document.getElementById('tarjetaVal');
const btn = document.getElementById('btnBuy');

// Restoration variables
const reparacionTarjeta = pTarjeta.innerText;

// Listeners for the inputs
inputTarjeta.addEventListener('change', getValueTarjeta);

$(document).ready(function () {
    $('#btnBuy').attr('disabled', true);
    $('#tarjeta').keyup(function () {
        if ($(this).val().trim().length == 16) {
            $('#btnBuy').attr('disabled', false);
        } else {
            $('#btnBuy').attr('disabled', true);
        }
    })
});

// Get the tarjeta input value
function getValueTarjeta(e) {
    // Consigo el valor del input y compruebo si no hay caracteres
    if (e.target.value.trim() == 0) {
        pTarjeta.innerText = reparacionTarjeta;
        let validacion = ' Campo Obligatorio (*)';
        pTarjeta.innerText += validacion;
        pTarjeta.style.color = "RED";
    } else if (e.target.value.trim() != 0) {
        pTarjeta.innerText = reparacionTarjeta;
        pTarjeta.style.color = "GREY";
        let noStartWS = e.target.value.trimStart();
        let withoutWS = noStartWS.replace(/\s/g, '');
        inputTarjeta.value = withoutWS;

        // If there isn't 16 caracteres the error
        if (inputTarjeta.value.length < 16) {
            pTarjeta.innerText = reparacionTarjeta;
            let validacion = ' Mínimo 16 Caracteres (*)';
            pTarjeta.innerText += validacion;
            pTarjeta.style.color = "RED";
        }
    }
}

$("#btnBuy").click(function () {
    console.log(inputTarjeta.value);
});
