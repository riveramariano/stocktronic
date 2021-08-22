<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Stocktronic - Inicio</title>

    <link href="images/isotipo.svg" type="image" rel="shortcut icon" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Raleway:300,600" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/registro.css">

</head>

<body class="bg-light">
    <!-- partial:index.partial.html -->
    <div class="container">

        <section id="formHolder" class="margin-top">
            <div class="row">

                <!-- Brand Box -->
                <div class="col-sm-6 brand">
                    <a href="#" class="logo">ST <span>.</span></a>

                    <div class="heading">
                        <h2>Stocktronic</h2>
                        <p>La elección correcta</p>
                    </div>

                    <div class="success-msg">
                        <p>Great! You are one of our members now</p>
                        <a href="#" class="profile">Your Profile</a>
                    </div>
                </div>


                <!-- Form Box -->
                <div class="col-sm-6 form">

                    <!-- Login Form -->
                    <div class="login form-peice">
                        <form class="login-form" action="#" method="post">
                            <div class="form-group">
                                <label for="">Correo Electrónico</label>
                                <input type="text" name="" id="emailLogin" class="emailLogin">
                                <span class="error"></span>
                            </div>

                            <div class="form-group">
                                <label for="">Contraseña</label>
                                <input type="password" name="" id="passwordLogin" class="passwordLogin">
                                <span class="error"></span>
                                <span class="error" id="loginHint"></span>
                            </div>
                            <div class="CTA">
                                <input type="submit" value="Iniciar Sesión" id="btnLogin" class="btn" />
                                <a href="#" class="switch">Crear una cuenta</a>
                            </div>
                        </form>
                    </div><!-- End Signup Form -->

                    <!-- Signup Form -->
                    <div class="signup form-peice switched">
                        <form class="signup-form" action="#" method="post">
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" name="name" id="name" class="name">
                                <span class="error"></span>
                            </div>
                            <div class="form-group">
                                <label for="">Primer Apellido</label>
                                <input type="text" name="lastName1" id="lastName1" class="lastName1">
                                <span class="error"></span>
                            </div>
                            <div class="form-group">
                                <label for="">Segundo Apellido</label>
                                <input type="text" name="lastName2" id="lastName2" class="lastName2">
                                <span class="error"></span>
                            </div>
                            <div class=" form-group">
                                <label for="">Correo Electrónico</label>
                                <input type="email" name="email" id="email" class="email" required>
                                <span class="error"></span>
                            </div>
                            <div class="form-group">
                                <label for="">Contraseña</label>
                                <input type="password" name="password" id="password" class="password">
                                <span class="error"></span>
                            </div>
                            <div class="CTA">
                                <input type="submit" id="btnRegister" value="Crear Cuenta" class="btn" />
                                <a href="#" class="switch">Iniciar sesión</a>
                            </div>
                        </form>
                    </div><!-- End Login Form -->

                </div>
        </section>
    </div>
    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
    <script src="./scripts/loginSP.js"></script>
    <script src="scripts/index.js"></script>

</body>

</html>