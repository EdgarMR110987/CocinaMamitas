<?php
ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);

require_once "../../../models/crud.php";

function cancelarPartidaVentaClienteController($id_partida_venta_cliente, $estado_partida, $id_venta, $subtotal_partida, $total_venta){
    $respuesta = Datos::cancelarPartidaVentaClienteModel($id_partida_venta_cliente, "partida_venta_c", $estado_partida, $id_venta ,$subtotal_partida, $total_venta);
    return $respuesta;
}

$id_p_v_c = $_POST["id_partida_venta_cliente"];
$estado = $_POST["estado_partida"];
$subtotal_partida = $_POST["subtotal_partida"];
$id_venta = $_POST["id_venta"];
$total_venta = $_POST["total_venta"];
$respuesta = cancelarPartidaVentaClienteController($id_p_v_c, $estado, $id_venta, $subtotal_partida, $total_venta);

echo $respuesta;
 
    
?>