<?php
/*
    Esta seria una forma de validar que el usuario este registrado
    para poder acceder al contenido de cada pagina, de lo contrario,
    el usurio sera redirigido al index para registrarse.    
*/

if (!isset($_SESSION['loggedUser'])) {
    header('Location: ../index.php ');
}
