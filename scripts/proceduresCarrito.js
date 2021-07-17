// This function will reduce the product quantity
$(".btnMinus").click(function () {
    var cantidad = $(this).attr("data-filter");
    if (cantidad == 1) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'No se puede reducir la cantidad',
            confirmButtonText: `Aceptar`
        });
    }  else {
        var id = $(this).attr("data-id");
        $.ajax({
            type: "GET",
            url: "../pages/updateCarrito.php",
            data: {
                idCarrito: id,
                cantidad: -1
            },
            success: function (data) {
                setTimeout(function () { location.reload(); }, 700);
            },
        });
    } 
});

// This function will increase the product quantity
$(".btnPlus").click(function () {
    var cantidad = $(this).attr("data-filter");
    if (cantidad == 5) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Límite de productos alcanzado!',
            confirmButtonText: `Aceptar`
        });
    } else {
        var id = $(this).attr("data-id");
        $.ajax({
            type: "GET",
            url: "../pages/updateCarrito.php",
            data: {
                idCarrito: id,
                cantidad: 1
            },
            success: function (data) {
                setTimeout(function () { location.reload(); }, 700);
            },
        });
    }
});

// This function will call an alert for the user
$(".btnDelete").click(function () {
    Swal.fire({
        icon: 'warning',
        title: 'Atención',
        text: 'Desea eliminar el producto?',
        showCancelButton: true,
        confirmButtonColor: '#b20000',
        confirmButtonText: `Eliminar`,
        denyButtonText: `Cancelar`,
    }).then((result) => {
        // If the user confirm the action, then the product is deleted
        if (result.isConfirmed) {
            var id = $(this).attr("data-id");
            $.ajax({
                type: "GET",
                url: "../pages/deleteCarrito.php",
                data: {
                    idCarrito: id
                },
                success: function (data) {
                    setTimeout(function () { location.reload(); }, 700);
                },
            });
        } 
    });
});
