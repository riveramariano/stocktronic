// The transition to the div with the id="productos" is smooth
$('a[href*="#"]')
    // Remove links that don't actually link to anything
    .not('[href="#"]')
    .not('[href="#0"]')
    .click(function (event) {
        // On-page links
        if (
            location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
            &&
            location.hostname == this.hostname
        ) {
            // Figure out element to scroll to
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            // Does a scroll target exist?
            if (target.length) {
                // Only prevent default if animation is actually gonna happen
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 1000, function () {
                    // Callback after animation
                    // Must change focus!
                    var $target = $(target);
                    $target.focus();
                    if ($target.is(":focus")) { // Checking if the target was focused
                        return false;
                    } else {
                        $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                        $target.focus(); // Set focus again
                    };
                });
            }
        }
    });

$(".btnAdd").click(function () {
    var id = $(this).attr("data-id");
    $.ajax({
        type: "GET",
        url: "../pages/carritoSP/insertCarrito.php",
        data: {
            ajaxid: id,
        },
        success: function (data) {
            $("#display_rows").html(data);
        },
    });
});

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
    } else {
        var id = $(this).attr("data-id");
        $.ajax({ 
            type: "GET",
            url: "../pages/carritoSP/updateCarrito.php",
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
            url: "../pages/carritoSP/updateCarrito.php",
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
        confirmButtonColor: '#DC143C',
        confirmButtonText: `Eliminar`,
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        // If the user confirm the action, then the product is deleted
        if (result.isConfirmed) {
            var id = $(this).attr("data-id");
            $.ajax({
                type: "GET",
                url: "../pages/carritoSP/deleteCarrito.php",
                data: {
                    idCarrito: id
                },
                success: function (data) {
                    setTimeout(Swal.fire({
                        icon: 'error',
                        title: 'Eliminando Producto',
                        showCancelButton: false,
                        showConfirmButton: false,
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        timer: 1000,
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
                    }), 1000);
                    setTimeout(function () { location.reload(); }, 1000);
                },
            });
        }
    });
});
