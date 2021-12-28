<?php 
    $editarVenta = new MvcController();
    $datos_venta = $editarVenta->editarVentaClienteController();
?>
<div class="container mt-6">
    <h4 class="mb-3 centrar"># VENTA <?php echo $datos_venta["id_venta_c"]; ?> </h4>
    <form action="" method="post">
        <div class="row">
            <div class="col-md-2 derecha mb-3">
                <span >Fecha : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">
                <input class="input-form" type="text" name="fecha_venta_c" id="fecha_venta_c" value="<?php echo $datos_venta["fecha_venta_c"]; ?>" readonly>
            </div>
            <div class="col-md-2 derecha mb-3">
                <span>Cliente : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">                
                <select class="input-form neg" name="id_cliente_venta_c" id="id_cliente_venta_c">
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
                <select class="input-form" name="forma_pago_venta_c" id="forma_pago_venta_c">
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
                <input class="input-form" type="text" name="comentarios_venta_c" id="comentarios_venta_c" value="<?php echo $datos_venta["comentarios_venta_c"]; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 centrar">
                <input type="button" onclick="imprimir(event)" class="btn btn-outline-info btn-lg" value="Imprimir">
            </div> 
        </div>
    </div>

<form action="" method="post">
    <div class="container">
        <div class="row">
            <div class="col-md-1 derecha mb-5">
                <span >Cant. : </span>
            </div>
            <div class="col-md-1 izquierda">
                <input type="hidden" name="id_venta_agregar_p" id="id_venta_c" value="<?php echo $datos_venta["id_venta_c"]; ?>">
                <input class="input-form" value="1" type="number" name="cant_partida_v" id="cant_partida_v">
            </div>
            <div class="col-md-4">                
                <select class="input-form" name="id_prod_venta" id="id_prod_venta">
                    <?php
                        $editarVenta->vistaProductosSelectVentaController();
                    ?>
                </select>
            </div>
            <div class="col-md-1 derecha mb-5">
                <span >Coment. : </span>
            </div>
            <div class="col-md-3 izquierda">
                <input class="input-form" type="text" name="comentarios_partida" id="comentarios_partida">
            </div>
            <div class="col-md-2">
                <input type="submit" class="btn btn-success" value="Agregar">
            </div>
        </div>
    </div>
    <?php
        $agregar = new MvcController();
        $agregar->agregarPartidaVentaController();
    ?>
</form>

    <div class="container">
        <div class="row">
            <div class="col-md-1 tabla-partida ocultar">ID Partida</div>
            <div class="col-md-1 tabla-partida">Cant.</div>
            <div class="col-md-2 tabla-partida">Descripción</div>
            <div class="col-md-2 tabla-partida">Subtotal</div>
            <div class="col-md-3 tabla-partida">Comentarios</div>
            <div class="col-md-1 tabla-partida">Estado</div>
            <div class="col-md-1 tabla-partida">Cancelar</div>
            <div class="col-md-1 tabla-partida">Eliminar</div>
        </div>
        <?php
            $partidas = $editarVenta->obtenerPartidasVentaClienteController($datos_venta["id_venta_c"]);
            foreach ($partidas as $key => $value) {
                $total_venta =+  $value["subtotal_partida"];
                echo '  <div class="row">
                            <div class="col-md-1 tabla-td-partida ocultar">'. $value["id_partida_venta_c"] .'</div>
                            <div class="col-md-1 tabla-td-partida">'. $value["cantidad_producto_partida"].'</div>
                            <div class="col-md-2 tabla-td-partida">'. $value["descripcion_p"].'</div>
                            <div class="col-md-2 tabla-td-partida">'. $value["subtotal_partida"].'</div>
                            <div class="col-md-3 tabla-td-partida">'. $value["comentarios_partida"].'</div>
                            <div class="col-md-1 tabla-td-partida">'. $value["estado_partida"].'</div>
                            <div class="col-md-1 tabla-td-partida">';
                                if($value["estado_partida"] != 'cancelado')
                        echo    '<a href="#" onclick="cancelarPartida(this)" id="'.$value["id_partida_venta_c"].'" class="btn btn-danger" data-subtotal_p="'.$value["subtotal_partida"].'" data-id_venta="'.$value["id_venta_c_partida"].'" data-total_venta="'.$datos_venta["total_venta_c"].'">
                                    Cancelar
                                </a>';
                                elseif($value["estado_partida"] == 'cancelado')
                        echo    '<a href="#" onclick="activarPartida(this)" id="'.$value["id_partida_venta_c"].'" class="btn btn-success" data-subtotal_p="'.$value["subtotal_partida"].'" data-id_venta="'.$value["id_venta_c_partida"].'" data-total_venta="'.$datos_venta["total_venta_c"].'">
                                    Activar
                                </a>';
                    echo    '</div>
                            <div class="col-md-1 tabla-td-partida">
                                <a href="#openModalEliminar" onclick="EliminarPartida(this)" id="'.$value["id_partida_venta_c"].'" data-valor="'.$value["descripcion_p"].'" data-subtotal_p="'.$value["subtotal_partida"].'" data-id_venta="'.$value["id_venta_c_partida"].'" data-total_venta="'.$datos_venta["total_venta_c"].'">
                                    <img class="img-25" src="views/img/eliminar.png">
                                </a>
                            </div>
                        </div>';
            }
            echo '  <div class="row">
                        <div class="col-md-6 derecha total">Total de la Venta</div>
                        <div class="col-md-2 centrar total"> $ '.$datos_venta["total_venta_c"].'</div>
                        <div class="col-md-3"></div>
                    </div>';
        ?>
    </div>

    </form>

    
 <!-- MODAL PARA ELIMINAR -->
 <form class="form" action="" method="post">
    <div id="openModalEliminar" class="modalDialog">
        <div class="preguntar">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Borrando Producto</h5>
                <a href="#close" title="Close" class="close">X</a>
                <input type="hidden" name="id_registro_borrar" id="id_registro_borrar">
                <input type="hidden" name="id_venta" id="id_venta">
                <input type="hidden" name="subtotal_p" id="subtotal_p">
                <input type="hidden" name="total_venta" id="total_venta">
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>¿Deseas Eliminar el Producto : &nbsp;</h6>
                        <h6 id="os"></h6>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cerrar-modal">Salir</button>
                <input class="btn btn-danger" type="submit" value="ELIMINAR">
            </div>
        </div>
    </div>


<!-- TERMINA EL MODAL PARA ELIMINAR -->

<?php 
    $eliminar = new MvcController();
    $link = "index.php?action=Ventas/editarVentaCliente&id_venta_editar=".$datos_venta["id_venta_c"];
    $eliminar -> borrarRegistroController("partida_venta_c","id_partida_venta_c", $link);
?>
</form>

<div class="container" style="margin-bottom: 65px; margin-top: -25px;">
    <div class="row">
        <div class="col mt-5 centrar">
            <input type="submit" class="btn-update" value="Actualizar">
            <input type="reset" class="btn btn-danger" value="Cancelar">
        </div>
    </div>
</div>