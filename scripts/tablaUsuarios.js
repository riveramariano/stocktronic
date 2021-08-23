$('.btnDelete').click(function () {
	// First calls a pop-up message
	Swal.fire({
		icon: 'warning',
		title: 'Atención',
		text: '¿Desea eliminar usuario?',
		showCancelButton: true,
		confirmButtonColor: '#DC143C',
		confirmButtonText: `Eliminar`,
		cancelButtonText: 'Cancelar',
	}).then((result) => {
		// If the user confirm the action, then it calls an AJAX
		if (result.isConfirmed) {
			// Important! This is the only way you could send an id that comes from an array
			var id = $(this).attr('data-id');
			console.log(id);
			// Start the AJAX
			$.ajax({
				type: 'GET',
				url: '../pages/usuarioSP/deleteUsuario.php',
				data: {
					idUsuario: id,
				},
				// If it succeded it sends a pop-up to the user
				success: function (data) {
					setTimeout(
						Swal.fire({
							icon: 'info',
							title: 'Usuario Eliminado Correctamente',
							text: 'Redirigiendo... espere unos segundos.',
							showCancelButton: false,
							showConfirmButton: false,
							allowEscapeKey: false,
							allowOutsideClick: false,
							timer: 3000,
							didOpen: () => {
								Swal.showLoading();
								timerInterval = setInterval(() => {
									const content = Swal.getHtmlContainer();
									if (content) {
										const b = content.querySelector('b');
										if (b) {
											b.textContent = Swal.getTimerLeft();
										}
									}
								}, 100);
							},
							willClose: () => {
								clearInterval(timerInterval);
							},
						}),
						3000
					);
					// Afther 3s the page will reload itsealf
					setTimeout(function () {
						window.location = 'tablaUsuarios.php';
					}, 3000);
				},
			});
		}
	});
});
