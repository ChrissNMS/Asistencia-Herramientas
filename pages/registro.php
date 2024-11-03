<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = uniqid();
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $nick = strtolower(substr($nombre, 0, 1) . $apellido);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Manejar la carga de la imagen
    $target_dir = "../fotos/";
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verificar si el archivo es una imagen real
    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
    if ($check === false) {
        die("El archivo no es una imagen.");
    }

    // Verificar el tamaño del archivo
    if ($_FILES["imagen"]["size"] > 500000) {
        die("El archivo es demasiado grande.");
    }

    // Permitir solo ciertos formatos de archivo
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        die("Solo se permiten archivos JPG, JPEG y PNG.");
    }

    // Mover el archivo cargado a la carpeta de destino
    if (!move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
        die("Hubo un error al cargar la imagen.");
    }

    $data = $id_usuario . "|" . $nombre . "|" . $apellido . "|" . $nick . "|" . $target_file . "|" . $password . PHP_EOL;

    $file = '../doc/usuarios.txt';
    file_put_contents($file, $data, FILE_APPEND | LOCK_EX);

    header("Location: ../index.php");
}
?>
<?php include('../header.php'); ?>
<body>
    <div class="container">
        <h2>Registro de Usuario</h2>
        <form action="registro.php" method="post" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-4">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>
            <div class="mb-4">
                <label for="imagen">Imagen (PNG o JPG)</label>
                <input type="file" class="form-control" id="imagen" name="imagen" accept=".png, .jpg, .jpeg" required>
            </div>
            <div class="mb-4">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrarse</button>
        </form>
    </div>
</body>

<?php include('../footer.php'); ?>