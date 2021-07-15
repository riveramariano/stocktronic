$(".btnDetalles").click(function() {
    var id = $(this).attr("data-id");

    $.ajax({
        type: "GET",
        url: "../pages/modalHistorial.php",
        data: {
            ajaxid: id,
        },
        success: function(data) {
            $("#display_rows").html(data);
        },
    });
});