<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv=”refresh” content=”15″>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js" integrity="sha512-VMsZqo0ar06BMtg0tPsdgRADvl0kDHpTbugCBBrL55KmucH6hP9zWdLIWY//OTfMnzz6xWQRxQqsUFefwHuHyg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <link rel="shortcut icon" href="views/img/Cubo.png" type="image/png">
    <link rel="stylesheet" href="css/estilosGeneral.css">
    <script type="text/javascript" src="js/sweetAlerts.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>


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