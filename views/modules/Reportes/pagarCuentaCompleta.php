<?php
ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);

require_once "../../../models/crud.php";

#METODO PARA COBRAR UNA VENTA A CUENTA DE UN CLIENTE
#SE ACTUALIZA EL SALDO DEL CLIENTE
$tabla = "venta_cliente";

	$datosControllerVenta = array("id_venta_c" => $_POST["id_venta_cobrar"]);
	$respuesta = Datos::actualizarEstadoVentaClientePagadaModel($tabla, $datosControllerVenta);
	$saldo_anterior = Datos::editarUsuarioModel($_POST["id_usuario"], "usuarios");
	$nvo_saldo = ($saldo_anterior["saldo_actual"] - $_POST["total_venta"]);
	$datosUpdate = array("saldo_actual" => $nvo_saldo, "id_usuario" => $_POST["id_usuario"]);
	$actualizarTotal = Datos::actualizarSaldoClienteModel($datosUpdate);
	return $respuesta;


?>