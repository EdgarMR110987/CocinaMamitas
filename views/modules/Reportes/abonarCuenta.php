<?php
ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);

require_once "../../../models/crud.php";

echo "Se abonara el importe de : " . $_POST["imp_abono"] . ", a la cuenta " . $_POST["id_venta_cliente"];

$nuevo_saldo = $_POST["saldo_anterior"] - $_POST["imp_abono"];

echo "El nuevo importe de la cuenta : " . $_POST["saldo_anterior"] .  " es de : " . $nuevo_saldo;

$datosController = array("id_venta_cliente" => $_POST["id_venta_cliente"], 
                        "importe_abono" =>  $_POST["imp_abono"],
                        "importe_anterior" => $_POST["saldo_anterior"]);
$respuesta = Datos::nuevaPartidaAbonoModel($datosController);

$saldo_anterior = Datos::editarUsuarioModel($_POST["id_usuario"], "usuarios");


$nvo_saldo = ($saldo_anterior["saldo_actual"] - $_POST["imp_abono"]);
$datosUpdate = array("saldo_actual" => $nvo_saldo, "id_usuario" => $_POST["id_usuario"]);
$actualizarTotal = Datos::actualizarSaldoClienteModel($datosUpdate);

$datosUpdateNvoSaldo = array("nvo_saldo" => $nuevo_saldo, "id_venta_c" => $_POST["id_venta_cliente"]);
$updateNvoSaldo = Datos::actualizarNvoSaldoVentaClienteModel($datosUpdateNvoSaldo);




?>