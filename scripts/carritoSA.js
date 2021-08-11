// This function trigger when you add a product to the cart
function addCart(nombre) {
    Swal.fire({
        // bottom-start, bottom-end, top-start
        position: "top-end",
        icon: "success",
        title: `${nombre} agregado al carrito`,
        showConfirmButton: false,
        timer: 2000,
        toast: true,
    });
}

// This function will trigger when you subtract a product quantity
function minusCart(nombre) { 
    Swal.fire({
        // bottom-start, bottom-end, top-start
        position: "top-end",
        icon: "error",
        title: `Se eliminó un/a ${nombre} del carrito`,
        showConfirmButton: false,
        timer: 2000,
        toast: true,
    });
}

// This function will trigger when you add a product quantity
function plusCart(nombre) {
    Swal.fire({
        // bottom-start, bottom-end, top-start
        position: "top-end",
        icon: "success",
        title: `Se agregó un/a ${nombre} al carrito`,
        showConfirmButton: false,
        timer: 2000,
        toast: true,
    });
}

/* The following functions prevent the page from reload when the product name is clicked
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