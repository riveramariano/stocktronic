// $("#submitBtn").click(function () {
//     var cantidad = $(this).attr("data-filter");
//     if (cantidad == 1) {
//         Swal.fire({
//             icon: 'error',
//             title: 'Oops...',
//             text: 'No se puede reducir la cantidad',
//             confirmButtonText: `Aceptar`
//         });
//     } else {
//         var id = $(this).attr("data-id");
//         $.ajax({
//             type: "GET",
//             url: "../pages/updateCarrito.php",
//             data: {
//                 idCarrito: id,
//                 cantidad: -1
//             },
//             success: function (data) {
//                 setTimeout(function () { location.reload(); }, 700);
//             },
//         });
//     }
// });

$("#submitBtn").click(function () {
    Swal.fire({
        icon: 'success',
        title: 'Producto Actualizado',
        text: 'El producto se ha actualizado correctamente',
        showConfirmButton: false
    });
});