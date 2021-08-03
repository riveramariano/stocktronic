// "Método Pago" select variable
const idVal = document.getElementById('idVal');
let inputID = document.getElementById('idProducto');

const nomVal = document.getElementById('nomVal');
let inputNombre = document.getElementById('nombre');

const descVal = document.getElementById('descVal');
let inputDesc = document.getElementById('desc');

const urlVal = document.getElementById('urlVal');
let inputURL = document.getElementById('url');

const precioVal = document.getElementById('precioVal');
let inputPrecio = document.getElementById('precio');

const cantVal = document.getElementById('cantVal');
let inputCant = document.getElementById('cant'); 

const proveedorVal = document.getElementById('proveedorVal');
let selectProveedor = document.getElementById('selectProveedor');

const categoriaVal = document.getElementById('categoriaVal');
let selectCategoria = document.getElementById('selectCategoria');

// Restoration variables, this works for the messages
const reparacionNom = nomVal.innerText;
const reparacionDesc = descVal.innerText;
const repacionURL = urlVal.innerText;
const reparacionPrecio = precioVal.innerText;
const reparacionCant = cantVal.innerText;

// Listeners for the changes in the inputs
inputNombre.addEventListener('change', getValueNombre);
inputDesc.addEventListener('change', getValueDescripcion);
inputURL.addEventListener('change', getValueURL);
inputPrecio.addEventListener('change', getValuePrecio);
inputCant.addEventListener('change', getValueCantidad);

// When something is digited into a input the functions cheks if the button need to be disable or not
$(document).ready(function () {
    $('#btnInsert').attr('disabled', true);
    let regexURL = /^(https?|http):\/\/[^\s$.?#].[^\s]*$/;
    $('input').keyup(function () {
        if (inputNombre.value.trim().length >= 5 && inputDesc.value.trim().length >= 5 && regexURL.test(inputURL.value)
            && inputPrecio.value.trim().length >= 1 && inputCant.value.trim().length >= 1) {
            $('#btnInsert').attr('disabled', false);
        } else {
            $('#btnInsert').attr('disabled', true);
        }
    });
});

// When something is digited into a input the functions cheks if the button need to be disable or not
$(document).ready(function () {
    $('#btnUpdate').attr('disabled', false);
    let regexURL = /^(https?|http):\/\/[^\s$.?#].[^\s]*$/;
    $('input').keyup(function () {
        if (inputNombre.value.trim().length >= 5 && inputDesc.value.trim().length >= 5 && regexURL.test(inputURL.value)
            && inputPrecio.value.trim().length >= 1 && inputCant.value.trim().length >= 1) {
            $('#btnUpdate').attr('disabled', false);
        } else {
            $('#btnUpdate').attr('disabled', true);
        }
    });
});

function getValueNombre(e) {
    if (e.target.value.trim() == 0) {
        nomVal.innerText = reparacionNom;
        let validacion = ' Obligatorio (*)';
        nomVal.innerText += validacion;
        nomVal.style.color = "RED";
    } else if (e.target.value.trim() != 0) {
        nomVal.innerText = reparacionNom;
        nomVal.style.color = "GREY";
        let noStartWS = e.target.value.trimStart();
        let withoutWS = noStartWS.replace(/  +/g, ' ');
        inputNombre.value = withoutWS;

        // If there isn't 16 caracteres print a message into the label
        if (inputNombre.value.length < 5) {
            nomVal.innerText = reparacionNom;
            let validacion = ' Mínimo 5 Caracteres (*)';
            nomVal.innerText += validacion;
            nomVal.style.color = "RED";
        } else {
            nomVal.innerText = reparacionNom;
            let validacion = ' Válido';
            nomVal.innerText += validacion;
            nomVal.style.color = "GREEN";
        }
    }
}

// This functions cheks if the input is blank or if the length < 16
function getValueDescripcion(e) {
    if (e.target.value.trim() == 0) {
        descVal.innerText = reparacionDesc;
        let validacion = ' Obligatorio (*)';
        descVal.innerText += validacion;
        descVal.style.color = "RED";
    } else if (e.target.value.trim() != 0) {
        descVal.innerText = reparacionDesc;
        descVal.style.color = "GREY";
        let noStartWS = e.target.value.trimStart();
        let withoutWS = noStartWS.replace(/  +/g, ' ');
        inputDesc.value = withoutWS;

        // If there isn't 16 caracteres print a message into the label
        if (inputDesc.value.length < 5) {
            descVal.innerText = reparacionDesc;
            let validacion = ' Mínimo 5 Caracteres (*)';
            descVal.innerText += validacion;
            descVal.style.color = "RED";
        } else {
            descVal.innerText = reparacionDesc;
            let validacion = ' Válida';
            descVal.innerText += validacion;
            descVal.style.color = "GREEN";
        }
    }
}

// This functions cheks if the input is blank or if the length < 16
function getValueURL(e) {
    if (e.target.value.trim() == 0) {
        urlVal.innerText = repacionURL;
        let validacion = ' Obligatorio (*)';
        urlVal.innerText += validacion;
        urlVal.style.color = "RED";
    } else if (e.target.value.trim() != 0) {
        urlVal.innerText = repacionURL;
        urlVal.style.color = "GREY";
        let noStartWS = e.target.value.trimStart();
        let withoutWS = noStartWS.replace(/\s/g, '');
        inputURL.value = withoutWS;

        // If there isn't 16 caracteres print a message into the label
        if (inputURL.value.length < 5) {
            urlVal.innerText = repacionURL;
            let validacion = ' No Válido';
            urlVal.innerText += validacion;
            urlVal.style.color = "RED";
        } 
        
        let regexURL = /^(https?|http):\/\/[^\s$.?#].[^\s]*$/;
        if (regexURL.test(inputURL.value)) {
            urlVal.innerText = repacionURL;
            let validacion = ' URL Válida';
            urlVal.innerText += validacion;
            urlVal.style.color = "GREEN";
        } else {
            urlVal.innerText = repacionURL;
            let validacion = ' No Válido';
            urlVal.innerText += validacion;
            urlVal.style.color = "RED";
        }
    }
}

// This functions cheks if the input is blank or if the length < 16
function getValuePrecio(e) {
    if (e.target.value.trim() == 0) {
        precioVal.innerText = reparacionPrecio;
        let validacion = ' Obligatorio (*)';
        precioVal.innerText += validacion;
        precioVal.style.color = "RED";
    } else if (e.target.value.trim() != 0) {
        precioVal.innerText = reparacionPrecio;
        precioVal.style.color = "GREY";
        let noStartWS = e.target.value.trimStart();
        let withoutWS = noStartWS.replace(/\s/g, '');
        inputPrecio.value = withoutWS;

        if (inputPrecio.value.length < 1) {
            precioVal.innerText = reparacionPrecio;
            let validacion = ' No Válido';
            precioVal.innerText += validacion;
            precioVal.style.color = "RED";
        } else {
            precioVal.innerText = reparacionPrecio;
            let validacion = ' Válido';
            precioVal.innerText += validacion;
            precioVal.style.color = "GREEN";
        }
    }
}

// This functions cheks if the input is blank or if the length < 16
function getValueCantidad(e) {
    if (e.target.value.trim() == 0) {
        cantVal.innerText = reparacionCant;
        let validacion = ' Obligatorio (*)';
        cantVal.innerText += validacion;
        cantVal.style.color = "RED";
    } else if (e.target.value.trim() != 0) {
        cantVal.innerText = reparacionCant;
        cantVal.style.color = "GREY";
        let noStartWS = e.target.value.trimStart();
        let withoutWS = noStartWS.replace(/\s/g, '');
        inputCant.value = withoutWS;

        if (inputCant.value.length < 1) {
            cantVal.innerText = reparacionCant;
            let validacion = ' No Válida';
            cantVal.innerText += validacion;
            cantVal.style.color = "RED";
        } else {
            cantVal.innerText = reparacionCant;
            let validacion = ' Válida';
            cantVal.innerText += validacion;
            cantVal.style.color = "GREEN";
        }
    }
}

$("#btnInsert").click(function (e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "../pages/productoSP/insertProducto.php",
        data: {
            nombre: inputNombre.value,
            desc: inputDesc.value,
            url: inputURL.value,
            precio: inputPrecio.value,
            cant: inputCant.value,
            idProveedor: selectProveedor.value,
            idCategoria: selectCategoria.value,
        },
        success: function (data) {
            setTimeout(Swal.fire({
                icon: 'success',
                title: 'Agregando Producto',
                text: 'Redirigiendo... espere unos segundos.',
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
                window.location = 'tablaProductos.php';
            }, 3000);
        },
    });
});

// This functions calls an ajax to insert the payment information
$("#btnUpdate").click(function (e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "../pages/productoSP/updateProducto.php",
        data: {
            id: inputID.value,
            nombre: inputNombre.value,
            desc: inputDesc.value,
            url: inputURL.value,
            precio: inputPrecio.value,
            cant: inputCant.value,
            idProveedor: selectProveedor.value,
            idCategoria: selectCategoria.value,
        },
        success: function (data) {
            Swal.fire({
                icon: 'success',
                title: 'Atención!',
                text: 'Producto actualizado correctamente.',
                confirmButtonText: 'Aceptar',
            });
        },
    });
});