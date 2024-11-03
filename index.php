<?php include('header.php'); ?>
<body>
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col"></div>
                <div class="text-start">
                    <div class="img/logo.png" width="48" alt="">
                </div>
                
                <h2 class="fw-bold text-center py-5">Bienvenido al trabajo</h2>

                <!-- Login -->
                
                <form action="pages/login.php" method="post">
                    <div class="mb-4">
                        <label for="nombre_usuario">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
                    </div>
                    <div class="mb-4">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <button type="sumbit" class="btn btn-primary">Iniciar Sesión</button>
                    <a href="pages/registro.php" class="btn btn-warning">Resgistrar</a>
                </form>

                </div>
            </div>
        </div>
    </div>
</body>
<?php include('footer.php'); ?>
