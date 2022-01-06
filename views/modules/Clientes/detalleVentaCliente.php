<style>
    .navbar {
        justify-content: center;
    }
</style>

<?php
$editarVenta = new MvcController();
$datos_venta = $editarVenta->editarVentaClienteController();
?>

<div class="container mt-6">
    <h4 class="mb-3 centrar"># VENTA <?php echo $datos_venta["id_venta_c"]; ?> </h4>
    <div class="row">
        <div class="col-md-2 derecha mb-3">
            <span>Fecha : </span>
        </div>
        <div class="col-md-4 izquierda mb-3">
            <input class="input-form" type="text" name="fecha_venta_c" id="fecha_venta_c" value="<?php echo $datos_venta["fecha_venta_c"]; ?>" readonly>
        </div>
        <div class="col-md-2 derecha mb-3">
            <span>Cliente : </span>
        </div>
        <div class="col-md-4 izquierda mb-3">
            <select class="input-form neg" name="id_cliente_venta_c" id="id_cliente_venta_c" disabled>
                <?php
                $editarVenta->vistaClientesSelectedController($datos_venta["id_cliente_venta_c"]);
                ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 derecha mb-3">
            <span>Forma de Pago : </span>
        </div>
        <div class="col-md-4 izquierda mb-3">
            <select class="input-form" name="forma_pago_venta_c" id="forma_pago_venta_c" disabled>
                <?php
                switch ($datos_venta["forma_pago_venta_c"]) {
                    case 'efectivo':
                        echo '  <option value="efectivo" selected>Efectivo</option>
                                        <option value="tarjeta">Tarjeta</option>
                                        <option value="cuenta">A cuenta</option>';
                        break;
                    case 'tarjeta':
                        echo '  <option value="efectivo">Efectivo</option>
                                        <option value="tarjeta" selected>Tarjeta</option>
                                        <option value="cuenta">A cuenta</option>';
                        break;
                    case 'cuenta':
                        echo '  <option value="efectivo">Efectivo</option>
                                        <option value="tarjeta">Tarjeta</option>
                                        <option value="cuenta" selected>A cuenta</option>';
                        break;
                }
                ?>

            </select>
        </div>
        <div class="col-md-2 derecha mb-3">
            <span>Comentarios : </span>
        </div>
        <div class="col-md-4 izquierda mb-3">
            <input class="input-form" type="text" name="comentarios_venta_c" id="comentarios_venta_c" value="<?php echo $datos_venta["comentarios_venta_c"]; ?>" readonly>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-2 tabla-partida ocultar">ID Partida</div>
        <div class="col-md-2 tabla-partida">Cant.</div>
        <div class="col-md-2 tabla-partida">Descripción</div>
        <div class="col-md-2 tabla-partida">Subtotal</div>
        <div class="col-md-3 tabla-partida">Comentarios</div>
        <div class="col-md-2 tabla-partida">Estado</div>
    </div>
    <?php
    $partidas = $editarVenta->obtenerPartidasVentaClienteController($datos_venta["id_venta_c"]);
    foreach ($partidas as $key => $value) {
        $total_venta = +$value["subtotal_partida"];
        echo '<div class="row">
                <div class="col-md-2 tabla-td-partida ocultar">' . $value["id_partida_venta_c"] . '</div>
                <div class="col-md-2 tabla-td-partida">' . $value["cantidad_producto_partida"] . '</div>
                <div class="col-md-2 tabla-td-partida">' . $value["descripcion_p"] . '</div>
                <div class="col-md-2 tabla-td-partida">' . $value["subtotal_partida"] . '</div>
                <div class="col-md-3 tabla-td-partida">' . $value["comentarios_partida"] . '</div>
                <div class="col-md-2 tabla-td-partida">' . $value["estado_partida"] . '</div>
            </div>';
    }
    echo '<div class="row">
            <div class="col-md-6 derecha total">Total de la Venta</div>
            <div class="col-md-2 centrar total"> $ ' . $datos_venta["total_venta_c"] . '</div>
            <div class="col-md-3"></div>
        </div>';
    ?>
</div>
<div class="row">
    <div class="col-md-12 centrar mt-4">
        <input type="button" onclick="imprimir(event)" class="btn btn-outline-info btn-lg" value="Imprimir">
    </div>
</div>