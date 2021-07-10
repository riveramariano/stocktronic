// This function will create the sweet alert, i passed all this params to make tests
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

/* The following functions prevent the page from reload when the add to cart button is press the or the product name
   If you find an easier way just change it :) */

// The next six are for the product names
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

// And these six are for the add to cart button
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