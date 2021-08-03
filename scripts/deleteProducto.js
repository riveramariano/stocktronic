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