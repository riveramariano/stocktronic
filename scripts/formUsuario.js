const idVal = document.getElementById('idVal');
let idUsuario = document.getElementById('idUsuario');
const nomVal = document.getElementById('nomVal');
let inputNombre = document.getElementById('nombre');
const appVal = document.getElementById('appVal');
let inputApellido1 = document.getElementById('apellido1');
const app2Val = document.getElementById('app2Val');
let inputApellido2 = document.getElementById('apellido2');
const emailVal = document.getElementById('emailVal');
let inputEmail = document.getElementById('email');
const passVal = document.getElementById('passVal');
let inputPassword = document.getElementById('password');
let selectTipo = document.getElementById('selectTipo');

const reparacionNom = nomVal.innerText;
const reparacionApp = appVal.innerText;
const reparacionApp2 = app2Val.innerText;
const reparacionEmail = emailVal.innerText;
const reparacionPassword = passVal.innerText;

inputNombre.addEventListener('change', getValueNombre);
inputApellido1.addEventListener('change', getValueApellido1);
inputApellido2.addEventListener('change', getValueApellido2);
inputEmail.addEventListener('change', getValueEmail);
inputPassword.addEventListener('change', getValuePassword);

$(document).ready(function () {
	$('#btnInsert').attr('disabled', true);
	let regexURL = /^(https?|http):\/\/[^\s$.?#].[^\s]*$/;
	$('input').keyup(function () {
		if (
			inputNombre.value.trim().length >= 3 &&
			inputApellido1.value.trim().length >= 3 &&
			inputApellido2.value.trim().length >= 3 &&
			inputEmail.value.trim().length >= 5 &&
			inputPassword.value.trim().length >= 3
		) {
			$('#btnInsert').attr('disabled', false);
		} else {
			$('#btnInsert').attr('disabled', true);
		}
	});
});

function getValueNombre(e) {
	if (e.target.value.trim() == 0) {
		nomVal.innerText = reparacionNom;
		let validacion = ' Obligatorio (*)';
		nomVal.innerText += validacion;
		nomVal.style.color = 'RED';
	} else if (e.target.value.trim() != 0) {
		nomVal.innerText = reparacionNom;
		nomVal.style.color = 'GREY';
		let noStartWS = e.target.value.trimStart();
		let withoutWS = noStartWS.replace(/  +/g, ' ');
		inputNombre.value = withoutWS;

		// If there isn't 16 caracteres print a message into the label
		if (inputNombre.value.length < 2) {
			nomVal.innerText = reparacionNom;
			let validacion = ' Mínimo 5 Caracteres (*)';
			nomVal.innerText += validacion;
			nomVal.style.color = 'RED';
		} else {
			nomVal.innerText = reparacionNom;
			let validacion = ' Válido';
			nomVal.innerText += validacion;
			nomVal.style.color = 'GREEN';
		}
	}
}
function getValueApellido1(e) {
	if (e.target.value.trim() == 0) {
		appVal.innerText = reparacionApp;
		let validacion = ' Obligatorio (*)';
		appVal.innerText += validacion;
		appVal.style.color = 'RED';
	} else if (e.target.value.trim() != 0) {
		appVal.innerText = reparacionApp;
		appVal.style.color = 'GREY';
		let noStartWS = e.target.value.trimStart();
		let withoutWS = noStartWS.replace(/  +/g, ' ');
		inputApellido1.value = withoutWS;

		// If there isn't 16 caracteres print a message into the label
		if (inputApellido1.value.length < 2) {
			appVal.innerText = reparacionApp;
			let validacion = ' Mínimo 5 Caracteres (*)';
			appVal.innerText += validacion;
			appVal.style.color = 'RED';
		} else {
			appVal.innerText = reparacionApp;
			let validacion = ' Válido';
			appVal.innerText += validacion;
			appVal.style.color = 'GREEN';
		}
	}
}
function getValueApellido2(e) {
	if (e.target.value.trim() == 0) {
		app2Val.innerText = reparacionApp2;
		let validacion = ' Obligatorio (*)';
		app2Val.innerText += validacion;
		app2Val.style.color = 'RED';
	} else if (e.target.value.trim() != 0) {
		app2Val.innerText = reparacionApp2;
		app2Val.style.color = 'GREY';
		let noStartWS = e.target.value.trimStart();
		let withoutWS = noStartWS.replace(/  +/g, ' ');
		inputApellido2.value = withoutWS;

		// If there isn't 16 caracteres print a message into the label
		if (inputApellido2.value.length < 2) {
			app2Val.innerText = reparacionApp2;
			let validacion = ' Mínimo 5 Caracteres (*)';
			app2Val.innerText += validacion;
			app2Val.style.color = 'RED';
		} else {
			app2Val.innerText = reparacionApp2;
			let validacion = ' Válido';
			app2Val.innerText += validacion;
			app2Val.style.color = 'GREEN';
		}
	}
}
function getValueEmail(e) {
	if (e.target.value.trim() == 0) {
		emailVal.innerText = reparacionEmail;
		let validacion = ' Obligatorio (*)';
		emailVal.innerText += validacion;
		emailVal.style.color = 'RED';
	} else if (e.target.value.trim() != 0) {
		emailVal.innerText = reparacionEmail;
		emailVal.style.color = 'GREY';
		let noStartWS = e.target.value.trimStart();
		let withoutWS = noStartWS.replace(/\s/g, '');
		inputEmail.value = withoutWS;

		// If there isn't 16 caracteres print a message into the label
		if (inputEmail.value.length < 5) {
			emailVal.innerText = reparacionEmail;
			let validacion = ' No Válido';
			emailVal.innerText += validacion;
			emailVal.style.color = 'RED';
		}

		let regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		if (regexEmail.test(inputEmail.value)) {
			emailVal.innerText = reparacionEmail;
			let validacion = ' Válido';
			emailVal.innerText += validacion;
			emailVal.style.color = 'GREEN';
		} else {
			emailVal.innerText = reparacionEmail;
			let validacion = ' No Válido';
			emailVal.innerText += validacion;
			emailVal.style.color = 'RED';
		}
	}
}
function getValuePassword(e) {
	if (e.target.value.trim() == 0) {
		passVal.innerText = reparacionPassword;
		let validacion = ' Obligatorio (*)';
		passVal.innerText += validacion;
		passVal.style.color = 'RED';
	} else if (e.target.value.trim() != 0) {
		passVal.innerText = reparacionPassword;
		passVal.style.color = 'GREY';
		let noStartWS = e.target.value.trimStart();
		let withoutWS = noStartWS.replace(/  +/g, ' ');
		inputPassword.value = withoutWS;

		// If there isn't 16 caracteres print a message into the label
		if (inputPassword.value.length < 5) {
			passVal.innerText = reparacionPassword;
			let validacion = ' Mínimo 5 Caracteres (*)';
			passVal.innerText += validacion;
			passVal.style.color = 'RED';
		} else {
			passVal.innerText = reparacionPassword;
			let validacion = ' Válida';
			passVal.innerText += validacion;
			passVal.style.color = 'GREEN';
		}
	}
}

$('#btnInsert').click(function (e) {
	e.preventDefault();
	console.log('test');
	$.ajax({
		type: 'GET',
		url: '../pages/usuarioSP/insertUsuario.php',
		data: {
			nombre: inputNombre.value,
			apellido1: inputApellido1.value,
			apellido2: inputApellido2.value,
			correo: inputEmail.value,
			passwrd: inputPassword.value,
			tipo: selectTipo.value,
		},
		success: function (data) {
			setTimeout(
				Swal.fire({
					icon: 'success',
					title: 'Creando usuario',
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
			setTimeout(function () {
				window.location = 'tablaUsuarios.php';
			}, 3000);
		},
	});
});
// This functions calls an ajax to insert the payment information
$('#btnUpdate').click(function (e) {
	e.preventDefault();
	$.ajax({
		type: 'GET',
		url: '../pages/usuarioSP/updateUsuario.php',
		data: {
			id: idUsuario.value,
			nombre: inputNombre.value,
			apellido1: inputApellido1.value,
			apellido2: inputApellido2.value,
			correo: inputEmail.value,
			passwrd: inputPassword.value,
			tipo: selectTipo.value,
		},
		success: function (data) {
			Swal.fire({
				icon: 'success',
				title: 'Atención!',
				text: 'Usuario actualizado correctamente.',
				confirmButtonText: 'Aceptar',
			});
			setTimeout(function () {
				window.location = 'tablaUsuarios.php';
			}, 3000);
		},
	});
});
