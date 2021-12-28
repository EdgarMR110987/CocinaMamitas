<div class="container mt-6">
    <h4 class="mb-3 centrar">VENTA A CLIENTE</h4>
    <form action="" method="post">
        <div class="row">
            <div class="col-md-2 derecha mb-3">
                <span >Fecha : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">
                <input class="input-form" type="text" name="fecha_venta_c" id="fecha_venta_c" value="<?php echo date("d-m-Y - H:m:s");?>" readonly>
            </div>
            <div class="col-md-2 derecha mb-3">
                <span>Cliente : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">                
                <select class="input-form" name="id_cliente_venta_c" id="id_cliente_venta_c">
                    <?php
                        $vistaCategorias = new MvcController();
                        $vistaCategorias->vistaClientesSelectController();
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 derecha mb-3">
                <span>Forma de Pago : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">                
                <select class="input-form" name="forma_pago_venta_c" id="forma_pago_venta_c">
                    <option value="" disabled selected>Selecciona una forma de pago . . .</option>
                    <option value="efectivo">Efectivo</option>
                    <option value="tarjeta">Tarjeta</option>
                    <option value="cuenta">A cuenta</option>
                </select>
            </div>
            <div class="col-md-2 derecha mb-3">
                <span>Comentarios : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">
                <input class="input-form" type="text" name="comentarios_venta_c" id="comentarios_venta_c">
            </div>
        </div>
        <div class="row">
            <div class="col mt-5 centrar">
                <input type="submit" class="btn btn-success" value="Nueva Venta">
                <input type="reset" class="btn btn-primary" value="Limpiar">
            </div>
        </div>
    </form>
</div>

<?php
    $nuevaVenta = new MvcController();
    $nuevaVenta -> registroVentaClienteController();
?>