/* This .js file is used in checkout.php it's function is to prevent the user from inserting invalid information */

// Bind the "Metodo Pago" into a variable
let selectMetodo = document.getElementById('selectMet'); 

// Bind the "Número Tarjeta" label and input into a variables
const pTarjeta = document.getElementById('tarjetaVal');
let inputTarjeta = document.getElementById('tarjeta');

// Bind the "Código de Seguridad" label and input into a variables
const pCVC = document.getElementById('cvcVal');
let inputCVC = document.getElementById('cvc');

// Bind the "Dirección Línea 1" label and input into a variables
const pDir1 = document.getElementById('dir1Val');
let inputDir1 = document.getElementById('dir1');

// Bind the "Dirección Línea 2" label and input into a variables
const pDir2 = document.getElementById('dir2Val');
let inputDir2 = document.getElementById('dir2');
 
// Bind the "Telefono" label and input into a variables
const pTel = document.getElementById('telVal');
let inputTel = document.getElementById('tel');

// Bind the "Código Postal" label and input into a variables
const pCod = document.getElementById('codVal');
let inputCod = document.getElementById('cod');

// Bind the "Confirmar Compra" button variable
const btn = document.getElementById('btnBuy');

// Restoration variables, this works for the aappend messages
const reparacionTarjeta = pTarjeta.innerText;
const reparacionCVC = pCVC.innerText;
const reparacionDir1 = pDir1.innerText;
const reparacionDir2 = pDir2.innerText;
const reparacionTel = pTel.innerText;
const reparacionCod = pCod.innerText;

// Listeners for the changes in the inputs
inputTarjeta.addEventListener('change', getValueTarjeta);
inputCVC.addEventListener('change', getValueCVC);
inputDir1.addEventListener('change', getValueDir1);
inputDir2.addEventListener('change', getValueDir2);
inputTel.addEventListener('change', getValueTel);
inputCod.addEventListener('change', getValueCod);

// Checks if the button needs to be disable or no, based on the input's information
$(document).ready(function () {
    $('#btnBuy').attr('disabled', true);
    $('input').keyup(function () {
        if (inputTarjeta.value.trim().length == 16 && inputCVC.value.trim().length == 3 && inputDir1.value.trim().length >= 5 
            && inputDir2.value.trim().length >= 5 && inputTel.value.trim().length == 8 && inputCod.value.trim().length == 5) {
            $('#btnBuy').attr('disabled', false);
        } else {
            $('#btnBuy').attr('disabled', true);
        }
    });
});

function getValueTarjeta(e) {
    // If the input value is 0, this one is for blank spaces
    if (e.target.value.trim() == 0) {
        pTarjeta.innerText = reparacionTarjeta;
        let validacion = ' Obligatorio (*)';
        pTarjeta.innerText += validacion;
        pTarjeta.style.color = "RED";
        // If the input value is no blank it deletes the blank spaces at the beggining and in between
    } else if (e.target.value.trim() != 0) {
        pTarjeta.innerText = reparacionTarjeta;
        pTarjeta.style.color = "GREY";
        let noStartWS = e.target.value.trimStart();
        let withoutWS = noStartWS.replace(/\s/g, '');
        inputTarjeta.value = withoutWS;
        // If the input length is < 16 prints a message else the user inserted valid information
        if (inputTarjeta.value.length < 16) {
            pTarjeta.innerText = reparacionTarjeta;
            let validacion = ' Mínimo 16 Caracteres (*)';
            pTarjeta.innerText += validacion;
            pTarjeta.style.color = "RED";
        } else {
            pTarjeta.innerText = reparacionTarjeta;
            let validacion = ' Válido';
            pTarjeta.innerText += validacion;
            pTarjeta.style.color = "GREEN";
        }
    }
}

function getValueCVC(e) {
    // If the input value is 0, this one is for blank spaces
    if (e.target.value.trim() == 0) {
        pCVC.innerText = reparacionCVC;
        let validacion = ' Obligatorio (*)';
        pCVC.innerText += validacion;
        pCVC.style.color = "RED";
        // If the input value is no blank it deletes the blank spaces at the beggining and in between
    } else if (e.target.value.trim() != 0) {
        pCVC.innerText = reparacionCVC;
        pCVC.style.color = "GREY";
        let noStartWS = e.target.value.trimStart();
        let withoutWS = noStartWS.replace(/\s/g, '');
        inputCVC.value = withoutWS;
        // If the input length is < 3 prints a message else the user inserted valid information
        if (inputCVC.value.length < 3) {
            pCVC.innerText = reparacionCVC;
            let validacion = ' Mínimo 3 Caracteres (*)';
            pCVC.innerText += validacion;
            pCVC.style.color = "RED";
        } else {
            pCVC.innerText = reparacionCVC;
            let validacion = ' Válido';
            pCVC.innerText += validacion;
            pCVC.style.color = "GREEN";
        }
    }
}

function getValueDir1(e) {
    // If the input value is 0, this one is for blank spaces
    if (e.target.value.trim() == 0) {
        pDir1.innerText = reparacionDir1;
        let validacion = ' Obligatorio (*)';
        pDir1.innerText += validacion;
        pDir1.style.color = "RED";
        // If the input value is no blank it deletes the blank spaces at the beggining and the replaces the double blank spaces in between
    } else if (e.target.value.trim() != 0) {
        pDir1.innerText = reparacionDir1;
        pDir1.style.color = "GREY";
        let noStartWS = e.target.value.trimStart();
        let withoutWS = noStartWS.replace(/  +/g, ' ');
        inputDir1.value = withoutWS;
    }
    // If the input length is < 5 prints a message else the user inserted valid information
    if (inputDir1.value.length < 5) {
        pDir1.innerText = reparacionDir1;
        let validacion = ' Mínimo 5 Caracteres (*)';
        pDir1.innerText += validacion;
        pDir1.style.color = "RED";
    } else {
        pDir1.innerText = reparacionDir1;
        let validacion = ' Válida';
        pDir1.innerText += validacion;
        pDir1.style.color = "GREEN";
    }
}

function getValueDir2(e) {
    // If the input value is 0, this one is for blank spaces
    if (e.target.value.trim() == 0) {
        pDir2.innerText = reparacionDir2;
        let validacion = ' Obligatorio (*)';
        pDir2.innerText += validacion;
        pDir2.style.color = "RED";
        // If the input value is no blank it deletes the blank spaces at the beggining and the replaces the double blank spaces in between
    } else if (e.target.value.trim() != 0) {
        pDir2.innerText = reparacionDir2;
        pDir2.style.color = "GREY";
        let noStartWS = e.target.value.trimStart();
        let withoutWS = noStartWS.replace(/  +/g, ' ');
        inputDir2.value = withoutWS;
    }

    // If the input length is < 5 prints a message else the user inserted valid information
    if (inputDir2.value.length < 5) {
        pDir2.innerText = reparacionDir2;
        let validacion = ' Mínimo 5 Caracteres (*)';
        pDir2.innerText += validacion;
        pDir2.style.color = "RED";
    } else {
        pDir2.innerText = reparacionDir2;
        let validacion = ' Válida';
        pDir2.innerText += validacion;
        pDir2.style.color = "GREEN";
    }
}

function getValueTel(e) {
    // If the input value is 0, this one is for blank spaces
    if (e.target.value.trim() == 0) {
        pTel.innerText = reparacionTel;
        let validacion = ' Obligatorio (*)';
        pTel.innerText += validacion;
        pTel.style.color = "RED";
        // If the input value is no blank it deletes the blank spaces at the beggining and in between
    } else if (e.target.value.trim() != 0) {
        pTel.innerText = reparacionTel;
        pTel.style.color = "GREY";
        let noStartWS = e.target.value.trimStart();
        let withoutWS = noStartWS.replace(/\s/g, '');
        inputTel.value = withoutWS;

        // If the input length is < 5 prints a message else the user inserted valid information
        if (inputTel.value.length < 8) {
            pTel.innerText = reparacionTel;
            let validacion = ' Mínimo 8 Caracteres (*)';
            pTel.innerText += validacion;
            pTel.style.color = "RED";
        } else {
            pTel.innerText = reparacionTel;
            let validacion = ' Válido';
            pTel.innerText += validacion;
            pTel.style.color = "GREEN";
        }
    }
}

function getValueCod(e) {
    // If the input value is 0, this one is for blank spaces
    if (e.target.value.trim() == 0) {
        pCod.innerText = reparacionCod;
        let validacion = ' Obligatorio (*)';
        pCod.innerText += validacion;
        pCod.style.color = "RED";
        // If the input value is no blank it deletes the blank spaces at the beggining and in between
    } else if (e.target.value.trim() != 0) {
        pCod.innerText = reparacionCod;
        pCod.style.color = "GREY";
        let noStartWS = e.target.value.trimStart();
        let withoutWS = noStartWS.replace(/\s/g, '');
        inputCod.value = withoutWS;

        // If the input length is < 5 prints a message else the user inserted valid information
        if (inputCod.value.length < 5) {
            pCod.innerText = reparacionCod;
            let validacion = ' Mínimo 5 Caracteres (*)';
            pCod.innerText += validacion;
            pCod.style.color = "RED";
        } else {
            pCod.innerText = reparacionCod;
            let validacion = ' Válido';
            pCod.innerText += validacion;
            pCod.style.color = "GREEN";
        }
    }
}

// This function is called when a button with the id btnBuy is clicked
$("#btnBuy").click(function () {
    // First it sends a pop-up to the user
    Swal.fire({
        icon: 'info',
        title: 'Atención',
        text: '¿Desea confirmar la compra?',
        showCancelButton: true,
        confirmButtonColor: '#00913f',
        cancelButtonColor: '#DC143C',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        // If the user confirm the action the continue the execution
        if (result.isConfirmed) {
            // The AJAX is called
            $.ajax({
                type: "GET",
                url: "../pages/infoPagoSP/insertInfoPago.php",
                data: {
                    metodoPago: selectMetodo.value,
                    numTarjeta: inputTarjeta.value,
                    dir1: inputDir1.value,
                    dir2: inputDir2.value,
                    telefono: inputTel.value,
                },
                // If it succeded then it sends a pop-up to the user
                success: function (data) {
                    setTimeout(Swal.fire({
                        icon: 'success',
                        title: 'Compra Realizada',
                        text: 'Espere unos segundos...',
                        showCancelButton: false,
                        showConfirmButton: false,
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        timer: 3000,
                        // This function works for printing the typical loading spiral
                        didOpen: () => {
                            Swal.showLoading()
                            timerInterval = setInterval(() => {
                                const content = Swal.getHtmlContainer()
                                if (content) {
                                    const b = content.querySelector('b')
                                    if (b) {
                                        b.textContent = Swal.getTimerLeft()
                                    }
                                }
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }), 3000);
                    // After 3s the page is redirected to confirmacion.php
                    setTimeout(function () {
                        window.location = 'confirmacion.php';
                    }, 3000);
                },
            });
        }
    });
});