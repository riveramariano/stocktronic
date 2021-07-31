// "Método Pago" select variable
let selectMetodo = document.getElementById('selectMet');

// "Fecha Expiración" input and label variables
let inputMM = document.getElementById('mm');
let inputYY = document.getElementById('yy');
const pFechaExpiracion = document.getElementById('fecVal');

// "Número Tarjeta" input and label variables
let inputTarjeta = document.getElementById('tarjeta');
const pTarjeta = document.getElementById('tarjetaVal');

// "Código de Seguridad" input and label variables
let inputCVC = document.getElementById('cvc');
const pCVC = document.getElementById('cvcVal');

// "Dirección Línea 1" input and label variables
let inputDir1 = document.getElementById('dir1');
const pDir1 = document.getElementById('dir1Val');

// "Dirección Línea 2" input and label variables
let inputDir2 = document.getElementById('dir2');
const pDir2 = document.getElementById('dir2Val');

// "Telefono" input and label variables
let inputTel = document.getElementById('tel');
const pTel = document.getElementById('telVal');

// "Código Postal" input and label variables
let inputCod = document.getElementById('cod');
const pCod = document.getElementById('codVal');

// "Confirmar Compra" button variable
const btn = document.getElementById('btnBuy');

// Restoration variables, this works for the messages
const reparacionMMYY = pFechaExpiracion.innerText;
const reparacionTarjeta = pTarjeta.innerText;
const reparacionCVC = pCVC.innerText;
const reparacionDir1 = pDir1.innerText;
const reparacionDir2 = pDir2.innerText;
const reparacionTel = pTel.innerText;
const reparacionCod = pCod.innerText;

// Listeners for the changes in the inputs
inputMM.addEventListener('change', getValueMM);
inputYY.addEventListener('change', getValueYY);
inputTarjeta.addEventListener('change', getValueTarjeta);
inputCVC.addEventListener('change', getValueCVC);
inputDir1.addEventListener('change', getValueDir1);
inputDir2.addEventListener('change', getValueDir2);
inputTel.addEventListener('change', getValueTel);
inputCod.addEventListener('change', getValueCod);

// When something is digited into a input the functions cheks if the button need to be disable or not
$(document).ready(function () {
    $('#btnBuy').attr('disabled', true);
    $('input').keyup(function () {
        if (inputMM.value.trim().length == 2 && inputYY.value.trim().length == 2 && inputTarjeta.value.trim().length == 16
            && inputCVC.value.trim().length >= 1 && inputDir1.value.trim().length >= 1 && inputDir2.value.trim().length >= 1
            && inputTel.value.trim().length == 8 && inputCod.value.trim().length >= 1) {
            $('#btnBuy').attr('disabled', false);
        } else {
            $('#btnBuy').attr('disabled', true);
        }
    });
});

// This functions cheks if the input is blank or if the length < 2
function getValueMM(e) {
    if (e.target.value.trim() == 0) {
        pFechaExpiracion.innerText = reparacionMMYY;
        let validacion = ' Obligatorio (*)';
        pFechaExpiracion.innerText += validacion;
        pFechaExpiracion.style.color = "RED";
    } else if (e.target.value.trim() != 0) {
        pFechaExpiracion.innerText = reparacionMMYY;
        pFechaExpiracion.style.color = "GREY";
        let noStartWS = e.target.value.trimStart();
        let withoutWS = noStartWS.replace(/\s/g, '');
        inputMM.value = withoutWS;

        // If there isn't 16 caracteres the error
        if (inputMM.value.length < 2) {
            pFechaExpiracion.innerText = reparacionMMYY;
            let validacion = ' Algo esta mal (*)';
            pFechaExpiracion.innerText += validacion;
            pFechaExpiracion.style.color = "RED";
        }
    }
}

// This functions cheks if the input is blank or if the length < 2
function getValueYY(e) {
    if (e.target.value.trim() == 0) {
        pFechaExpiracion.innerText = reparacionMMYY;
        let validacion = ' Obligatorio (*)';
        pFechaExpiracion.innerText += validacion;
        pFechaExpiracion.style.color = "RED";
    } else if (e.target.value.trim() != 0) {
        pFechaExpiracion.innerText = reparacionMMYY;
        pFechaExpiracion.style.color = "GREY";
        let noStartWS = e.target.value.trimStart();
        let withoutWS = noStartWS.replace(/\s/g, '');
        inputYY.value = withoutWS;

        // If there isn't 16 caracteres the error
        if (inputYY.value.length < 2) {
            pFechaExpiracion.innerText = reparacionMMYY;
            let validacion = ' Algo esta mal (*)';
            pFechaExpiracion.innerText += validacion;
            pFechaExpiracion.style.color = "RED";
        }
    }
}

// This functions cheks if the input is blank or if the length < 16
function getValueTarjeta(e) {
    // Consigo el valor del input y compruebo si no hay caracteres
    if (e.target.value.trim() == 0) {
        pTarjeta.innerText = reparacionTarjeta;
        let validacion = ' Obligatorio (*)';
        pTarjeta.innerText += validacion;
        pTarjeta.style.color = "RED";
    } else if (e.target.value.trim() != 0) {
        pTarjeta.innerText = reparacionTarjeta;
        pTarjeta.style.color = "GREY";
        let noStartWS = e.target.value.trimStart();
        let withoutWS = noStartWS.replace(/\s/g, '');
        inputTarjeta.value = withoutWS;

        // If there isn't 16 caracteres print a message into the label
        if (inputTarjeta.value.length < 16) {
            pTarjeta.innerText = reparacionTarjeta;
            let validacion = ' Mínimo 16 Caracteres (*)';
            pTarjeta.innerText += validacion;
            pTarjeta.style.color = "RED";
        }
    }
}

// This functions cheks if the input is blank or if the length < 3
function getValueCVC(e) {
    if (e.target.value.trim() == 0) {
        pCVC.innerText = reparacionCVC;
        let validacion = ' Obligatorio (*)';
        pCVC.innerText += validacion;
        pCVC.style.color = "RED";
    } else if (e.target.value.trim() != 0) {
        pCVC.innerText = reparacionCVC;
        pCVC.style.color = "GREY";
        let noStartWS = e.target.value.trimStart();
        let withoutWS = noStartWS.replace(/\s/g, '');
        inputCVC.value = withoutWS;

        // If there isn't 3 caracteres print a message into the label
        if (inputCVC.value.length < 3) {
            pCVC.innerText = reparacionCVC;
            let validacion = ' Mínimo 3 Caracteres (*)';
            pCVC.innerText += validacion;
            pCVC.style.color = "RED";
        }
    }
}

// This functions cheks if the input is blank
function getValueDir1(e) {
    if (e.target.value.trim() == 0) {
        pDir1.innerText = reparacionDir1;
        let validacion = ' Obligatorio (*)';
        pDir1.innerText += validacion;
        pDir1.style.color = "RED";
    } else if (e.target.value.trim() != 0) {
        pDir1.innerText = reparacionDir1;
        pDir1.style.color = "GREY";
        let noStartWS = e.target.value.trimStart();
        let withoutWS = noStartWS.replace(/  +/g, ' ');
        inputDir1.value = withoutWS;
    }
}

// This functions cheks if the input is blank
function getValueDir2(e) {
    if (e.target.value.trim() == 0) {
        pDir2.innerText = reparacionDir2;
        let validacion = ' Obligatorio (*)';
        pDir2.innerText += validacion;
        pDir2.style.color = "RED";
    } else if (e.target.value.trim() != 0) {
        pDir2.innerText = reparacionDir2;
        pDir2.style.color = "GREY";
        let noStartWS = e.target.value.trimStart();
        let withoutWS = noStartWS.replace(/  +/g, ' ');
        inputDir2.value = withoutWS;
    }
}

// This functions cheks if the input is blank or if the length < 8
function getValueTel(e) {
    if (e.target.value.trim() == 0) {
        pTel.innerText = reparacionTel;
        let validacion = ' Obligatorio (*)';
        pTel.innerText += validacion;
        pTel.style.color = "RED";
    } else if (e.target.value.trim() != 0) {
        pTel.innerText = reparacionTel;
        pTel.style.color = "GREY";
        let noStartWS = e.target.value.trimStart();
        let withoutWS = noStartWS.replace(/\s/g, '');
        inputTel.value = withoutWS;

        // If there isn't 8 caracteres print a message into the label
        if (inputTel.value.length < 8) {
            pTel.innerText = reparacionTel;
            let validacion = ' Mínimo 8 Caracteres (*)';
            pTel.innerText += validacion;
            pTel.style.color = "RED";
        }
    }
}

// This functions cheks if the input is blank
function getValueCod(e) {
    if (e.target.value.trim() == 0) {
        pCod.innerText = reparacionCod;
        let validacion = ' Obligatorio (*)';
        pCod.innerText += validacion;
        pCod.style.color = "RED";
    } else if (e.target.value.trim() != 0) {
        pCod.innerText = reparacionCod;
        pCod.style.color = "GREY";
        let noStartWS = e.target.value.trimStart();
        let withoutWS = noStartWS.replace(/\s/g, '');
        inputCod.value = withoutWS;
    }
}

// This functions calls an ajax to insert the payment information
$("#btnBuy").click(function () {
    Swal.fire({
        icon: 'info',
        title: 'Atención',
        text: 'Desea confirmar la compra?',
        showCancelButton: true,
        confirmButtonColor: '#00913f',
        cancelButtonColor: '#DC143C',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                url: "../pages/checkoutSP.php",
                data: {
                    metodoPago: selectMetodo.value,
                    numTarjeta: inputTarjeta.value,
                    dir1: inputDir1.value,
                    dir2: inputDir2.value,
                    telefono: inputTel.value,
                },
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
                    setTimeout(function () {
                        window.location = 'confirmacion.php';
                    }, 3000);
                },
            });
        }
    });
});