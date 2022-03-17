<?php
    $Venta = new MvcController();
    $ultimo_registro_c = $Venta->vistaUltimaVentaClienteController();
?>
<div class="container-fluid mt-6">
    <div class="row">
        <div class="col-md-2 derecha mb-1">
            <h3>Venta : <?php echo $ultimo_registro_c["id_venta_c"]; ?> </h3>
        </div>
        <div class="col-md-5 derecha mb-1">
                <h3>Cliente : <?php echo $ultimo_registro_c["usuario"]; ?> </h3>
            </div>
            <div class="col-md-5 derecha mb-1">
                <h3>Fecha : <?php echo $ultimo_registro_c["fecha_venta_c"]; ?> </h3>
            </div>
    </div>
    <div class="row">
            <div class="col-md-2 derecha">
                <h3><?php echo strtoupper($ultimo_registro_c["forma_pago_venta_c"]); ?> </h3>
            </div>
            <div class="col-md-5 derecha">
                <h3><?php echo strtoupper($ultimo_registro_c["estado_venta_c"]); ?> </h3>
            </div>
            <div class="col-md-5 derecha">
                <h5>Comentarios : <?php echo $ultimo_registro_c["comentarios_venta_c"]; ?> </h5>
            </div>
    </div>
 


<form action="" method="post" id="agregarProducto">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1 derecha mb-5">
                <span >Cant. : </span>
            </div>
            <div class="col-md-1 izquierda">
                <input type="hidden" name="perfil" value="<?php echo $ultimo_registro_c["perfil"]; ?>">
                <input type="hidden" name="id_venta_agregar_p" id="id_venta_c" value="<?php echo $ultimo_registro_c["id_venta_c"]; ?>">
                <input type="hidden" id="id_cliente_venta_c" value="<?php echo $ultimo_registro_c["id_usuario"]; ?>">
                <input type="hidden" name="estado_venta_c" value="<?php echo $ultimo_registro_c["estado_venta_c"]; ?>">
                <input class="input-form" min="1" value="1" type="number" name="cant_partida_v" id="cant_partida_v">
            </div>

            <div class="col-md-1 derecha mb-5">
                <span >Coment. : </span>
            </div>
            <div class="col-md-2 izquierda">
                <input class="input-form" type="text" name="comentarios_partida" id="comentarios_partida">
            </div>

            <div id="panel-categorias" class="col-md-7">                
                    <?php
                        $Venta->vistaCategoriasVentaController();
                    ?>
            </div>
            <div id="productos-id" class="col-md-7">
            </div>
            <input type='hidden' name='id_prod_venta' id='id_prod_venta'>
        </div>
    </div>
    <?php
        $agregar = new MvcController();
        $agregar->agregarNuevaPartidaVentaController();
    ?>
</form>

<div class="container">
        <div class="row">
            <div class="col-md-1 tabla-partida ocultar">ID Partida</div>
            <div class="col-md-1 tabla-partida">Cant.</div>
            <div class="col-md-3 tabla-partida">Descripción</div>
            <div class="col-md-2 tabla-partida">Subtotal</div>
            <div class="col-md-3 tabla-partida">Comentarios</div>
            <div class="col-md-1 tabla-partida">Estado</div>
            
            <div class="col-md-1 tabla-partida">Cancelar</div>
            <div class="col-md-1 tabla-partida">Eliminar</div>
        </div>
        <?php
            $partidas = $Venta->obtenerPartidasVentaClienteController($ultimo_registro_c["id_venta_c"]);
            foreach ($partidas as $key => $value) {
                $total_venta =+  $value["subtotal_partida"];
                echo '  <div class="row">
                            <div class="col-md-1 tabla-td-partida ocultar">'. $value["id_partida_venta_c"] .'</div>
                            <div class="col-md-1 tabla-td-partida">'. $value["cantidad_producto_partida"].'</div>
                            <div class="col-md-3 tabla-td-partida">'. $value["descripcion_p"].'</div>
                            <div class="col-md-2 tabla-td-partida">'. $value["subtotal_partida"].'</div>
                            <div class="col-md-3 tabla-td-partida">'. $value["comentarios_partida"].'</div>
                            <div class="col-md-1 tabla-td-partida">'. $value["estado_partida"].'</div>
                           
                            <div class="col-md-1 tabla-td-partida">';
                                if($value["estado_partida"] != 'cancelado')
                        echo    '<a href="#" onclick="cancelarPartida(this)" id="'.$value["id_partida_venta_c"].'" class="btn btn-danger" data-subtotal_p="'.$value["subtotal_partida"].'" data-id_venta="'.$value["id_venta_c_partida"].'" data-total_venta="'.$ultimo_registro_c["total_venta_c"].'">
                                    Cancelar
                                </a>';
                                elseif($value["estado_partida"] == 'cancelado')
                        echo    '<a href="#" onclick="activarPartida(this)" id="'.$value["id_partida_venta_c"].'" class="btn btn-success" data-subtotal_p="'.$value["subtotal_partida"].'" data-id_venta="'.$value["id_venta_c_partida"].'" data-total_venta="'.$ultimo_registro_c["total_venta_c"].'">
                                    Activar
                                </a>';
                    echo    '</div>
                            <div class="col-md-1 tabla-td-partida">
                                <a href="#openModalEliminar" onclick="EliminarPartida(this)" id="'.$value["id_partida_venta_c"].'" data-valor="'.$value["descripcion_p"].'" data-subtotal_p="'.$value["subtotal_partida"].'" data-id_venta="'.$value["id_venta_c_partida"].'" data-total_venta="'.$ultimo_registro_c["total_venta_c"].'">
                                    <img class="img-25" src="views/img/eliminar.png">
                                </a>
                            </div>
                        </div>';
            }
            echo '  <div class="row">
                        <div class="col-md-6 derecha total">Total de la Venta</div>
                        <div class="col-md-2 centrar total"> $ '.$ultimo_registro_c["total_venta_c"].'</div>
                        <div class="col-md-3"></div>
                    </div>';
        ?>
    </div>

 
 <!-- MODAL PARA ELIMINAR -->
 <form class="form" action="" method="post">
    <div id="openModalEliminar" class="modalDialog">
        <div class="preguntar">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Borrando Producto</h5>
                <a href="#close" title="Close" class="close">X</a>
                <input type="hidden" name="id_registro_borrar" id="id_registro_borrar">
                <input type="hidden" name="id_cliente_venta_c" id="id_cliente_venta_c" value="<?php echo $ultimo_registro_c["id_usuario"]; ?>">
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
    $link = "index.php?action=Ventas/agregarProductoVentaCliente";
    $eliminar -> borrarRegistroController("partida_venta_c","id_partida_venta_c", $link);
?>
</form>

<div class="row">
    <div class="col-md-2 centrar">
        <input type="button" onclick="imprimir(event)" class="btn btn-outline-info btn-lg" value="Imprimir">
    </div> 
</div>