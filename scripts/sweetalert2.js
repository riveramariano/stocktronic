function addCart(nombre, cantidad, idUsuario, idProducto) {

    var nuevoId = parseInt(idProducto);

    Swal.fire({
        position: "top-end",
        icon: "success",
        title: `${nombre} agregado al carrito`,
        showConfirmButton: false,
        timer: 2000,
        toast: true,
    });
}


// Los siguientes metodos solo sirven para que al presionar los nombres de los productos
// y los botones de agregar al carrito la pagina no se recargue

// No recargar página al dar clic al nombre del producto
$("#productName1").on("click", function(e) {
    e.preventDefault();
    var url = $(this).attr("href");
    $.get(url, function() {
        // Success
    });
});

$("#productName2").on("click", function(e) {
    e.preventDefault();
    var url = $(this).attr("href");
    $.get(url, function() {
        // Success
    });
});

$("#productName3").on("click", function(e) {
    e.preventDefault();
    var url = $(this).attr("href");
    $.get(url, function() {
        // Success
    });
});

$("#productName4").on("click", function(e) {
    e.preventDefault();
    var url = $(this).attr("href");
    $.get(url, function() {
        // Success
    });
});

$("#productName5").on("click", function(e) {
    e.preventDefault();
    var url = $(this).attr("href");
    $.get(url, function() {
        // Success
    });
});

$("#productName6").on("click", function(e) {
    e.preventDefault();
    var url = $(this).attr("href");
    $.get(url, function() {
        // Success
    });
});


// No recargar página al agregar producto al carrito
$("#cart1").on("click", function(e) {
    e.preventDefault();
    var url = $(this).attr("href");
    $.get(url, function() {
        // Success
    });
});

$("#cart2").on("click", function(e) {
    e.preventDefault();
    var url = $(this).attr("href");
    $.get(url, function() {
        // Success
    });
});

$("#cart3").on("click", function(e) {
    e.preventDefault();
    var url = $(this).attr("href");
    $.get(url, function() {
        // Success
    });
});

$("#cart4").on("click", function(e) {
    e.preventDefault();
    var url = $(this).attr("href");
    $.get(url, function() {
        // Success
    });
});

$("#cart5").on("click", function(e) {
    e.preventDefault();
    var url = $(this).attr("href");
    $.get(url, function() {
        // Success
    });
});

$("#cart6").on("click", function(e) {
    e.preventDefault();
    var url = $(this).attr("href");
    $.get(url, function() {
        // Success
    });
});