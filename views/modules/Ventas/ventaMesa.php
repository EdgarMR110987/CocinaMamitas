<div class="container mt-6">
    <h4 class="mb-3 centrar">VENTA A MESA</h4>
    <form action="" method="post">
        <div class="row">
            <div class="col-md-2 derecha mb-3">
                <span>Fecha : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">
                <input class="input-form" type="text" name="fecha_venta_m" id="fecha_venta_m" value="<?php echo date("d-m-Y - H:m:s"); ?>" readonly>
            </div>
            <div class="col-md-2 derecha mb-3">
                <span>Mesero : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">
                <select class="input-form" name="id_usuario_venta_m" id="id_usuario_venta_m">
                    <?php
                        $vista = new mvcController();
                        $vista->vistaUsuariosMeseroController();
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 derecha mb-3">
                <span>Forma de Pago : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">
                <select class="input-form" name="forma_pago_m" id="forma_pago_m">
                    <option value="" disabled selected>Selecciona una forma de pago . . .</option>
                    <option value="efectivo">Efectivo</option>
                    <option value="tarjeta">Tarjeta</option>
                    <option value="mixta">Mixta</option>
                </select>
            </div>
            <div class="col-md-2 derecha mb-3">
                <span>Mesa : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">
                <input class="input-form" type="text" name="id_mesa_venta_m" id="id_mesa_venta_m">
            </div>
        </div>
        <div class="row">
            <div class="col mt-5 centrar">
                <a href="#openModalEliminar" onclick="clickactionVentaNvaMesa(this)" class="btn btn-success">Nueva Venta</a>
                <input type="reset" class="btn btn-primary" value="Limpiar">
            </div>
        </div>
</div>

<!-- MODAL PARA ELIMINAR -->

    <div id="openModalEliminar" class="modalDialog">
        <div class="preguntar">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Nueva Venta</h5>
                <a href="#close" title="Close" class="close">X</a>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6" style="width:100%">
                        <h6>¿Deseas abrir una nueva venta para la mesa &nbsp;</h6>
                        <h6 id="os"></h6>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cerrar-modal">Salir</button>
                <input class="btn btn-success" type="submit" value="Registrar">
            </div>
        </div>
    </div>
    <?php
        $vista->registroVentaMesaController();
    ?>
</form>