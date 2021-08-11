$("#logout").click(function () {
    // First it sends a pop-up to the user
    Swal.fire({
        icon: 'warning',
        title: 'Cerrar Sesión?',
        showCancelButton: true,
        confirmButtonColor: '#DC143C',
        confirmButtonText: `Cerrar`,
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        // If the user confirm the action the continue the execution
        if (result.isConfirmed) {
            // The AJAX is called
            $.ajax({
                type: "GET",
                url: "../pages/usuarioSP/logout.php",
                // If it succeded then it sends a pop-up to the user
                success: function (data) {
                    setTimeout(Swal.fire({
                        icon: 'info',
                        title: 'Cerrando Sesión',
                        text: 'Espere unos segundos...',
                        showCancelButton: false,
                        showConfirmButton: false,
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        timer: 2000,
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
                    }), 2000);
                    // After 3s the page is redirected to confirmacion.php
                    setTimeout(function () {
                        window.location = '../index.php';
                    }, 2000);
                },
            });
        }
    });
});
