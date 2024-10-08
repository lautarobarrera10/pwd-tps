<?php

require_once("../../utils/functions.php");
require_once("../../../configuracion.php");
include_once("../estructura/menu/menu_accion.php");

use Control\AbmAuto;
use Control\AbmPersona;

?>
<!DOCTYPE html>
<html>
<head>
    <title>Resultado de la Búsqueda</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script type="text/javascript" src="../assets/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/css/inicio.css">

</head>

<body class="bg-dark">
    <?php
    $rutalogo = "../assets/img/";
    include_once("../estructura/Navbar.php");
    ?>

    <main class="container-fluid cont container text-light">

    
    <h1>Resultado de la Búsqueda</h1>

    <?php
   
    $datos = darDatosSubmitted();


    if (isset($datos['patente'])) {
        $patente = $datos['patente'];


        $abmAuto = new AbmAuto();
        $abmPersona = new AbmPersona();


        $auto = $abmAuto->obtenerDatosAuto($patente);


        if ($auto !== null) {
            
            $duenio = $auto->getDuenio();
            $duenio->buscar();
            $salida = <<<TABLA
            <table class="table table-dark">
            <tr><th>Patente</th><th>Marca</th><th>Modelo</th><th>Dueño</th></tr>
            <tr>
            <td>{$auto->getPatente()}</td>
            <td>{$auto->getMarca()}</td>
            <td>{$auto->getModelo()}</td>
            <td>{$duenio->getNombre()}  {$duenio->getApellido()}</td>
            </tr>
            </table>
            TABLA;
           
        } else {
            $salida = "<p>No se encontró ningún auto con la patente ingresada.</p>";
        }
    } else {
        $salida = "<p>No se proporcionó una patente válida.</p>";
    }

    echo $salida;
    ?>

</main>

<div class="contenedor">
</div>
<?php
    include_once("../estructura/Footer.php");
    ?>



</body>

</html>