// This function will reduce the quantity of the selected product
$(".btnMinus").click(function () {
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
});

// This function will increase the quantity of the selected product
$(".btnPlus").click(function () {
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
});

// This function will delete the selected product
$(".btnDelete").click(function () {
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
});
