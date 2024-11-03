<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['nombre_usuario'];
    $password = $_POST['password'];

    $file = '../doc/usuarios.txt';
    $usuarios = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    $login_exitoso = false;
    foreach ($usuarios as $usuario) {
        list($id_usuario, $nombre, $apellido, $nick, $url_imagen, $hash_password) = explode("|", $usuario);

        if ($nombre_usuario == $nick && password_verify($password, $hash_password)) {

            $_SESSION['usuario_id'] = $id_usuario;
            $_SESSION['nombre_usuario'] = $nombre_usuario;
            header("Location: asistencia.php");
            exit();
        }
    }

    // Mensaje de error si las credenciales son incorrectas
    echo "Nombre de usuario o contraseña incorrectos.";
}
?>
