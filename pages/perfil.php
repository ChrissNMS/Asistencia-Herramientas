<?php
session_start();
include('../header.php');

// Verificar si el usuario está autenticado


// Obtener el ID del usuario desde la sesión
$usuario_id = $_SESSION['usuario_id'];

$archivo_usuarios = '../doc/usuarios.txt';

// Leer los datos del usuario desde el archivo
$usuario_info = null;

if (file_exists($archivo_usuarios)) {
    $lineas = file($archivo_usuarios, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lineas as $linea) {
        list($id, $nombre, $apellido, $nick, $imagen, $password) = explode('|', $linea);
        if ($id === $usuario_id) {
            $usuario_info = [
                'id' => $id,
                'nombre' => $nombre,
                'apellido' => $apellido,
                'imagen' => $imagen,
            ];
            break; // Salir del bucle una vez encontrado el usuario
        }
    }
}

if (!$usuario_info) {
    echo "Usuario no encontrado.";
    exit;
}
?>

<body>
    <header>
            <div class="content">
                <div class="menu container">
                    <a href="index.html" class="logo">logo</a>
                    <input type="checkbox" id="menu" />
                    <label for="menu">
                        <img src="imagenes/menu.png" class="menu-icono" alt="">
                    </label>
                    <nav class="navbar">
                        <ul>
                            <li><a class="nav-link" href="asistencia.php">Inicio</a></li>
                            <li><a class="nav-link" href="perfil.php">Perfil</a></li>
                            <li><a class="nav-link" href="cerrarsesion.php">Salir</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
    <div class="container">
        <h2>Perfil del Usuario</h2>
        <div class="profile">
            <img src="<?php echo $usuario_info['imagen']; ?>" alt="Foto de perfil" class="img-fluid" style="width: 150px; height: auto;">
            <h3><?php echo $usuario_info['nombre'] . ' ' . $usuario_info['apellido']; ?></h3>
            <p>ID de Usuario: <?php echo $usuario_info['id']; ?></p>
        </div>
    </div>
</body>

<?php include('../footer.php'); ?>
