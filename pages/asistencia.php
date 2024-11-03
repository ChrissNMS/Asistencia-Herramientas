<?php
session_start();
include('../header.php');
?>
<body>
    <!-- El menú no me salio intente aprender con un tutorial, pero no me salio, pero igualmente sirven los hipervinculos, lo que no me salio fue el diseño-->
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

    <div class="container my-3">
        <h1 class="my-4">Registro de Asistencia</h1>
        <!--Se muestra la fecha con date-->
        <p class="fecha col-md-6 mx-auto text-center my-4">
            <strong>Fecha:</strong>
            <?php echo date("d-m-Y"); ?>
        </p>

        <!-- Formularios para registrar horas de la mañana -->
        <div class="mb-4">
            <h2>Registrar Horas de la Mañana</h2>
            <div class="row">
                <!-- Formulario de entrada de la mañana -->
                <form action="registroasis.php" method="post" class="col-md-6">
                    <label for="entrada_am" class="form-label">Hora de Entrada</label>
                    <input type="time" class="form-control" id="entrada_am" name="entrada_am" required>
                    <input type="hidden" name="tipo" value="entrada_am">
                    <button type="submit" class="btn btn-primary mt-3">Registrar Entrada</button>
                </form>

                <!-- Formulario de salida de la mañana -->
                <form action="registroasis.php" method="post" class="col-md-6">
                    <label for="salida_am" class="form-label">Hora de Salida</label>
                    <input type="time" class="form-control" id="salida_am" name="salida_am" required>
                    <input type="hidden" name="tipo" value="salida_am">
                    <button type="submit" class="btn btn-primary mt-3">Registrar Salida</button>
                </form>
            </div>
        </div>

        <div class="mb-4">
            <h2>Registrar Horas de la Tarde</h2>
            <div class="row">
                <!-- Formulario de entrada de la mañana -->
                <form action="registroasis.php" method="post" class="col-md-6">
                    <label for="entrada_am" class="form-label">Hora de Entrada</label>
                    <input type="time" class="form-control" id="entrada_pm" name="entrada_pm" required>
                    <input type="hidden" name="tipo" value="entrada_pm">
                    <button type="submit" class="btn btn-primary mt-3">Registrar Entrada</button>
                </form>

                <!-- Formulario de salida de la mañana -->
                <form action="registroasis.php" method="post" class="col-md-6">
                    <label for="salida_am" class="form-label">Hora de Salida</label>
                    <input type="time" class="form-control" id="salida_pm" name="salida_pm" required>
                    <input type="hidden" name="tipo" value="salida_pm">
                    <button type="submit" class="btn btn-primary mt-3">Registrar Salida</button>
                </form>
            </div>
        </div>

        <!--Se crea una tabla con Fecha, etradas,salidas y el total -->
        <div class="col-md-6 mx-auto text-center my-4">
            <h1>Horario Semanal</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Entrada Mañana</th>
                        <th>Salida Mañana</th>
                        <th>Entrada Tarde</th>
                        <th>Salida Tarde</th>
                        <th>Total de horas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $archivo = '../doc/registros_asistencia.txt';

                    if (file_exists($archivo)) {
                        $lineas = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

                        foreach ($lineas as $linea) {
                            list($fecha, $entrada_am, $salida_am, $entrada_pm, $salida_pm) = explode('|', $linea);
                            $total = '';

                            if ($entrada_am && $salida_am) {
                                $total_manana = (strtotime($salida_am) - strtotime($entrada_am));
                            } else {
                                $total_manana = 0;
                            }

                            if ($entrada_pm && $salida_pm) {
                                $total_tarde = (strtotime($salida_pm) - strtotime($entrada_pm));
                            } else {
                                $total_tarde = 0;
                            }

                            $total = gmdate("H:i", $total_manana + $total_tarde);

                            echo "<tr>";
                            echo "<td>$fecha</td>";
                            echo "<td>$entrada_am</td>";
                            echo "<td>$salida_am</td>";
                            echo "<td>$entrada_pm</td>";
                            echo "<td>$salida_pm</td>";
                            echo "<td>$total</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No hay registros disponibles.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

<?php include('../footer.php'); ?>