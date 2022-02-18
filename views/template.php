<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv=”refresh” content=”15″>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/sweetAlerts.js"></script>
    <script src="js/sweetalert2.all.js"></script>
    <link rel="stylesheet" href="css/sweetalert.css" />
    <link rel="stylesheet" href="css/sweetalert2.css">
    <link rel="stylesheet" href="css/estilosGeneral.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" href="views/img/Cubo.png" type="image/png">    
</head>

<body>
    <section>
        <?php

        session_start();
        if (isset($_SESSION["perfil"])) {
            switch ($_SESSION["perfil"]) {
                case "administrador":
                    if (isset($_SESSION["id_usuario"]))
                        include "views/navegacion.php";
                    $mvc = new MvcController();
                    $mvc->enlacesPaginasController();
                    echo "</section>";
                    include "footer.php";
                    break;
                case "cajero";
                    if (isset($_SESSION["id_usuario"]))
                    include "views/navegacion.php";
                    $mvc = new MvcController();
                    $mvc->enlacesPaginasController();
                    echo "</section>";
                    include "footer.php";
                break;
                case "cliente";
                    if (isset($_SESSION["id_usuario"]))
                    include "views/navegacionCliente.php";
                    $mvc = new MvcController();
                    $mvc->enlacesPaginasClienteController();
                    echo "</section>";
                    include "footer.php";
                break;
            }
        } else {
            $mvc = new MvcController();
            $mvc->enlacesPaginasController();
            echo "</section>";
        }
        ?>

</body>

</html>