// "Método Pago" select variable
let idProducto = document.getElementById('idProducto');
let nombreProducto = document.getElementById('nombre');
let descProducto = document.getElementById('desc');
let urlProducto = document.getElementById('url');
let precioProducto = document.getElementById('precio');
let cantProducto = document.getElementById('cant');
let idProveedor = document.getElementById('selectProveedor');
let idCategoria = document.getElementById('selectCategoria');

$("#btnInsert").click(function (e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "../pages/productoSP/insertProducto.php",
        data: {
            nombre: nombreProducto.value,
            desc: descProducto.value,
            url: urlProducto.value,
            precio: precioProducto.value,
            cant: cantProducto.value,
            idProveedor: idProveedor.value,
            idCategoria: idCategoria.value,
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
            id: idProducto.value,
            nombre: nombreProducto.value,
            desc: descProducto.value,
            url: urlProducto.value,
            precio: precioProducto.value,
            cant: cantProducto.value,
            idProveedor: idProveedor.value,
            idCategoria: idCategoria.value,
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

$(".btnDelete").click(function () {
    Swal.fire({
        icon: 'warning',
        title: 'Atención',
        text: '¿Desea eliminar el producto?',
        showCancelButton: true,
        confirmButtonColor: '#DC143C',
        confirmButtonText: `Eliminar`,
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        // If the user confirm the action, then the product is deleted
        if (result.isConfirmed) {
            var id = $(this).attr("data-id");
            $.ajax({
                type: "GET",
                url: "../pages/productoSP/deleteProducto.php",
                data: {
                    idProducto: id
                },
                success: function (data) { 
                    setTimeout(Swal.fire({
                        icon: 'info',
                        title: 'Producto Eliminado Correctamente',
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
        }
    });
});