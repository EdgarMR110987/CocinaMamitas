<?php
ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);

require_once "../../../models/crud.php";

function busquedaVentaMesasController($columna, $valor){
    $respuesta = Datos::busquedaVentaMesasModel($columna, "venta_mesa", $valor);
    return $respuesta;
}

function busquedaVentaMesasIntController($columna, $valor){
    $respuesta = Datos::busquedaVentaMesasIntModel($columna, "venta_mesa", $valor);
    return $respuesta;
}

function busquedaFechaVentaMesasController($fecha_inicio, $fecha_termino){
    $respuesta = Datos::busquedaFechaVentaMesasModel("venta_mesa", $fecha_inicio, $fecha_termino);
    return $respuesta;
}


if($_POST["tipo"] == "int"){   
    $columna = $_POST["columna"];
    $valor = $_POST["valor"];
    $respuesta = busquedaVentaMesasIntController($columna, $valor);
}elseif($_POST["tipo"] == "fecha"){
    $fecha_inicio = $_POST["fecha_inicio"];
    $fecha_termino = $_POST["fecha_termino"];
    $fi = date_create($fecha_inicio);
    $ff = date_create($fecha_termino);
    $fi = date_add($fi, date_interval_create_from_date_string("18 hours"));
    $ff = date_add($ff, date_interval_create_from_date_string("12 hours"));
    $fecha_inicio = date_format($fi,"Y-m-d H:i:s");
    $fecha_termino = date_format($ff,"Y-m-d H:i:s");
    echo $fecha_inicio;
    echo $fecha_termino;
    $respuesta = busquedaFechaVentaMesasController($fecha_inicio, $fecha_termino);
}else{
    $columna = $_POST["columna"];
    $valor = $_POST["valor"];
    $respuesta = busquedaVentaMesasController($columna, $valor);
}

$total = 0;
    foreach ($respuesta as $usuario => $value) {
        $total += $value["total_venta_m"];
    echo "<tr>
            <td>".$value["id_venta_m"]."</td>
            <td>".$value["vendedor"]."</td>
            <td>".$value["num_mesa"]."</td>
            <td>".strtoupper($value["forma_pago_m"])."</td>
            <td>".$value["fecha_venta_m"]."</td>
            <td> $ ".$value["total_venta_m"]."</td>
            <td>
                <span class='".$value["estado_venta_m"]."'>".strtoupper($value["estado_venta_m"])."</span>
            </td>
            <td>".$value["imp_efectivo"]."</td>
            <td>".$value["imp_tarjeta"]."</td>
            <td>
                <a data-bs-toggle='modal' href='index.php?action=Ventas/editarVentaCliente&id_venta_editar=".$value["id_venta_m"]."' role='button'>
                    <img class='img-25' src='views/img/editar.png'>
                </a>
            </td>
            <td>
                <a href='#openModalEliminar' onclick='clickactionEliminar(this)' id='".$value["id_venta_m"]."' data-valor='".$value["id_venta_m"]."'>
                    <img class='img-25' src='views/img/eliminar.png'>
                </a>
            </td>
          </tr>";
}
echo " <tr>
<td colspan='7' class='pt-3 derecha'><h5>TOTAL DE VENTAS : </h5></td>
<td colspan='4' class='pt-3 izquierda'><h5> $". $total ."</h5></td>
</tr>"


?>