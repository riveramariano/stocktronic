let inputEmailLogin = document.getElementById('emailLogin');
let inputPasswordLogin = document.getElementById('passwordLogin');

let inputName = document.getElementById('name');
let inputLastName1 = document.getElementById('lastName1');
let inputLastName2 = document.getElementById('lastName2');
let inputEmail = document.getElementById('email');
let inputPassword = document.getElementById('password');

$(document).ready(function () {

    // This is the validation for the login button, delete this one when the loginSP validation works
    $('#btnLogin').attr('disabled', true);
    $('input').keyup(function () {
        let regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (regexEmail.test(inputEmailLogin.value) && inputPasswordLogin.value.trim().length > 0) {
            $('#btnLogin').attr('disabled', false);
        } else {
            $('#btnLogin').attr('disabled', true);
        }
    });

    $('#btnRegister').attr('disabled', true);
    $('input').keyup(function () {
        let regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (inputName.value.trim().length > 1 && inputLastName1.value.trim().length > 1 && inputLastName2.value.trim().length > 1
            && regexEmail.test(inputEmail.value) && inputPassword.value.trim().length >= 8) {
            $('#btnRegister').attr('disabled', false);
        } else {
            $('#btnRegister').attr('disabled', true);
        }
    });

    'use strict';

    var usernameError = true,
        emailError = true,
        passwordError = true,
        lastName1Error = true,
        lastName2Error = true,
        emailLogin = true,
        passwordLogin = true;

    // Detect browser for css purpose
    if (navigator.userAgent.toLowerCase().indexOf('firefox') > -1) {
        $('.form form label').addClass('fontSwitch');
    }

    // Label effect
    $('input').focus(function () {
        $(this).siblings('label').addClass('active');
    });

    // Form validation
    $('input').blur(function () {

        // Email Login
        if ($(this).hasClass('emailLogin')) {
            let regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if ($(this).val().length == '') {
                $(this).siblings('span.error').text('Campo obligatorio (*)').fadeIn().parent('.form-group').addClass('hasError');
                emailLogin = true;
            } else if (!regexEmail.test($(this).val())) {
                $(this).siblings('span.error').text('Dirección de correo inválida (*)').fadeIn().parent('.form-group').addClass('hasError');
                emailError = true;
            } else {
                $(this).siblings('.error').text('').fadeOut().parent('.form-group').removeClass('hasError');
                emailLogin = false;
            }
        }

        // Password Login
        if ($(this).hasClass('passwordLogin')) {
            if ($(this).val().length === 0) {
                $(this).siblings('span.error').text('Campo obligatorio (*)').fadeIn().parent('.form-group').addClass('hasError');
                passwordLogin = true;
            } else {
                $(this).siblings('.error').text('').fadeOut().parent('.form-group').removeClass('hasError');
                passwordLogin = false;
            }
        }

        // Username
        if ($(this).hasClass('name')) {
            if ($(this).val().length === 0) {
                $(this).siblings('span.error').text('Campo obligatorio (*)').fadeIn().parent('.form-group').addClass('hasError');
                usernameError = true;
            } else if ($(this).val().length > 0 && $(this).val().length < 2) {
                $(this).siblings('span.error').text('Debe tener almenos 2 caracteres').fadeIn().parent('.form-group').addClass('hasError');
                usernameError = true;
            } else {
                $(this).siblings('.error').text('').fadeOut().parent('.form-group').removeClass('hasError');
                usernameError = false;
            }
        }

        // Lastname1
        if ($(this).hasClass('lastName1')) {
            if ($(this).val().length === 0) {
                $(this).siblings('span.error').text('Campo obligatorio (*)').fadeIn().parent('.form-group').addClass('hasError');
                lastName1Error = true;
            } else if ($(this).val().length > 0 && $(this).val().length < 2) {
                $(this).siblings('span.error').text('Debe tener almenos 2 caracteres').fadeIn().parent('.form-group').addClass('hasError');
                lastName1Error = true;
            } else {
                $(this).siblings('.error').text('').fadeOut().parent('.form-group').removeClass('hasError');
                lastName1Error = false;
            }
        }

        // Lastname2
        if ($(this).hasClass('lastName2')) {
            if ($(this).val().length === 0) {
                $(this).siblings('span.error').text('Campo obligatorio (*)').fadeIn().parent('.form-group').addClass('hasError');
                lastName2Error = true;
            } else if ($(this).val().length > 0 && $(this).val().length < 2) {
                $(this).siblings('span.error').text('Debe tener almenos 2 caracteres').fadeIn().parent('.form-group').addClass('hasError');
                lastName2Error = true;
            } else {
                $(this).siblings('.error').text('').fadeOut().parent('.form-group').removeClass('hasError');
                lastName2Error = false;
            }
        }

        // Email
        if ($(this).hasClass('email')) {
            let regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if ($(this).val().length == '') {
                $(this).siblings('span.error').text('Campo obligatorio (*)').fadeIn().parent('.form-group').addClass('hasError');
                emailError = true;
            } else if (!regexEmail.test($(this).val())) {
                $(this).siblings('span.error').text('Dirección de correo inválida (*)').fadeIn().parent('.form-group').addClass('hasError');
                emailError = true;
            } else {
                $(this).siblings('.error').text('').fadeOut().parent('.form-group').removeClass('hasError');
                emailError = false;
            }
        }

        // Password
        if ($(this).hasClass('password')) {
            if ($(this).val().length > 8) {
                $(this).siblings('span.error').text('Debe tener almenos 8 caracteres').fadeIn().parent('.form-group').addClass('hasError');
                passwordError = true;
            } else {
                $(this).siblings('.error').text('').fadeOut().parent('.form-group').removeClass('hasError');
                passwordError = false;
            }
        }

    });

    // Form submit
    $('form.signup-form').submit(function (event) {
        event.preventDefault();
        if (usernameError == true || lastName1Error == true || lastName2Error == true || emailError == true || passwordError == true) {
            $('.name, .email, .lastName1, .lastName2, .email, .password').blur();
        } else {
            // This functions calls an ajax to insert the payment information

        }
    });

    // Form submit
    $('form.login-form').submit(function (event) {
        event.preventDefault();
        if (emailLogin == true || passwordLogin == true) {
            $('.emailLogin, .passwordLogin').blur();
        } else {
            // This functions calls an ajax to insert the payment information

        }
    });

});

$("#btnLogin").click(function (e) {
    e.preventDefault();
    let email = document.getElementById('emailLogin').value;
    let passwrd = document.getElementById('passwordLogin').value;
    $.ajax({
        type: 'GET',
        url: './pages/loginSP/countRowsLogin.php',
        data: {
            p_email: email,
            p_passwrd: passwrd,
        },
        success: function (data) {
            if (data == 'Correo electrónico o contraseña no validos') {
                console.log(data);
                console.log('Test');
                $('#loginHint')
                    .text(data)
                    .fadeIn()
                    .parent('.form-group')
                    .addClass('hasError');
            } else {
                $('#loginHint')
                    .siblings('.error')
                    .text('')
                    .fadeIn()
                    .parent('.form-group')
                    .removeClass('hasError');
                $.ajax({
                    type: "GET",
                    url: "pages/usuarioSP/login.php",
                    data: {
                        emailLogin: inputEmailLogin.value,
                        passwordLogin: inputPasswordLogin.value,
                    },
                    success: function (data) {
                        setTimeout(Swal.fire({
                            position: "top-end",
                            icon: 'success',
                            title: 'Iniciando sesión',
                            heightAuto: false,
                            showCancelButton: false,
                            showConfirmButton: false,
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                            toast: true,
                            timer: 3000,
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
                        }), 1000);
                        setTimeout(function () {
                            window.location = 'pages/inicio.php';
                        }, 1000);
                    },
                });
            }
        },
    });
});

$("#btnRegister").click(function (e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "pages/usuarioSP/registro.php",
        data: {
            nombre: inputName.value,
            primerApellido: inputLastName1.value,
            segundoApellido: inputLastName2.value,
            email: inputEmail.value,
            password: inputPassword.value,
        },
        success: function (data) {
            setTimeout(Swal.fire({
                position: "top-end",
                icon: 'success',
                title: 'Registro exitoso, iniciando sesión',
                heightAuto: false,
                showCancelButton: false,
                showConfirmButton: false,
                allowEscapeKey: false,
                allowOutsideClick: false,
                toast: true,
                timer: 3000,
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
            setTimeout(function () {
                window.location = 'pages/inicio.php';
            }, 2000);
        },
    });
});

// form switch
$('a.switch').click(function (e) {
    $(this).toggleClass('active');
    e.preventDefault();

    if ($('a.switch').hasClass('active')) {
        $(this).parents('.form-peice').addClass('switched').siblings('.form-peice').removeClass('switched');
    } else {
        $(this).parents('.form-peice').removeClass('switched').siblings('.form-peice').addClass('switched');
    }
});
