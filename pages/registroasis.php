<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipo = $_POST['tipo'];
    $hora = $_POST[$tipo];
    $fecha = date("d-m-Y");

    $archivo = '../doc/registros_asistencia.txt';

    $lineas = file_exists($archivo) ? file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];
    $registro_existente = false;

    foreach ($lineas as &$linea) {
        list($fecha_registro, $entrada_am, $salida_am, $entrada_pm, $salida_pm) = explode('|', $linea);
        if ($fecha_registro === $fecha) {
            $registro_existente = true;
            switch ($tipo) {
                case 'entrada_am':
                    $linea = "$fecha|$hora|$salida_am|$entrada_pm|$salida_pm";
                    break;
                case 'salida_am':
                    $linea = "$fecha|$entrada_am|$hora|$entrada_pm|$salida_pm";
                    break;
                case 'entrada_pm':
                    $linea = "$fecha|$entrada_am|$salida_am|$hora|$salida_pm";
                    break;
                case 'salida_pm':
                    $linea = "$fecha|$entrada_am|$salida_am|$entrada_pm|$hora";
                    break;
            }
            break; // Asegúrate de que esta línea esté bien indentada y cerrada.
        }
    }

    if (!$registro_existente) {
        $nueva_linea = "$fecha|||||"; // Valor por defecto
        switch ($tipo) {
            case 'entrada_am':
                $nueva_linea = "$fecha|$hora|||";
                break;
            case 'salida_am':
                $nueva_linea = "$fecha||$hora||";
                break;
            case 'entrada_pm':
                $nueva_linea = "$fecha|||$hora|";
                break;
            case 'salida_pm':
                $nueva_linea = "$fecha||||$hora";
                break;
        }
        $lineas[] = $nueva_linea; // Agregar nueva línea si no existe el registro
    }

    file_put_contents($archivo, implode("\n", $lineas) . "\n"); // Guardar en el archivo

    // Redirigir de vuelta a la página principal
    header("Location: asistencia.php"); // Asegúrate de que el formato de la redirección sea correcto
    exit;
}
?>