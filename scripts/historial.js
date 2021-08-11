// When the button "Detalles" is clicked it calls an ajax that calls an php that returns the table in the modal
$(".btnDetalles").click(function () {
    var id = $(this).attr("data-id");
    $.ajax({
        type: "GET",
        url: "../pages/ordenesSP/detalleOrdenes.php",
        data: {
            ajaxid: id,
        },
        success: function (data) {
            $("#display_rows").html(data);
        },
    });
});

$(document).ready(function () {
    $('#tblHistorial').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ],
        language: {
            url: "http://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
        }
    }
    );
});
