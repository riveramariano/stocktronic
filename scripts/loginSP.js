$('#btnLogin').click(function () {
	let email = document.getElementById('emailLogin').value;
	let passwrd = document.getElementById('passwordLogin').value;
	console.log(email, passwrd);
	$.ajax({
		type: 'GET',
		url: './pages/loginSP/countRowsLogin.php',
		data: {
			p_email: email,
			p_passwrd: passwrd,
		},
		success: function (data) {
			console.log(data);
			console.log('Test');
			$('#loginHint')
				.text(data)
				.fadeIn()
				.parent('.form-group')
				.addClass('hasError');
		},
	});
});
