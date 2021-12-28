<?php
//INSERTAMOS LA VENTA 
$vistaVentaMesa = new mvcController();
$vistaVentaM = $vistaVentaMesa -> vistaVentaMesaController();
$datetime = DateTime::createFromFormat('Y-m-d H:i:s', $vistaVentaM["fecha_venta_m"]);
$newDate = $datetime->format('H:i:s d-m-Y');
?>

<div class="container-fluid mt-6">
    <form action="" method="post" id="form-cobrar">
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-4">
                    <h4 class="centrar">Atendido por : <?php $vistaVentaMesa->nombreUsuarioController($vistaVentaM["num_mesa"]); ?></h4>
                </div>
                <div class="col-md-2">
                    <h4 class="centrar">Mesa : <?php echo $vistaVentaM["num_mesa"]?></h4>
                    <input type="hidden" name="id_mesa_venta_m" id="id_mesa_venta_m" value="<?php echo $vistaVentaM["id_mesa_venta_m"]; ?>">
                </div>
                <div class="col-md-2">
                    <h4 class="centrar"># Venta : <?php echo $vistaVentaM["id_venta_m"]?></h4>
                    <input type="hidden" name="id_venta_m" id="id_venta_m" value="<?php echo $vistaVentaM["id_venta_m"]; ?>">
                </div>
                <div class="col-md-3">
                    <h4 class="centrar"><?php echo $newDate; ?></h4>
                    <input type="hidden" name="total_venta_m" id="total_venta_m" value="<?php echo $vistaVentaM["total_venta_m"]; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <h4 class="derecha">Forma Pago : </h4>
                </div>
                <div class="col-md-2">
                    <select class="input-form custom-select-lg mb-3" name="forma_pago_mesa" id="forma_pago_mesa">
                        <?php 
                            switch ($vistaVentaM["forma_pago_m"]) {
                                case 'Efectivo':
                                    echo "  <option value='Efectivo' selected>Efectivo</option>
                                            <option value='Tarjeta'>Tarjeta</option>
                                            <option value='Mixta'>Mixta</option>";
                                    break;
                                case 'Tarjeta':
                                    echo "  <option value='Efectivo'>Efectivo</option>
                                            <option value='Tarjeta' selected>Tarjeta</option>
                                            <option value='Mixta'>Mixta</option>";
                                    break;
                                case 'Mixta':
                                    echo "  <option value='Efectivo'>Efectivo</option>
                                            <option value='Tarjeta'>Tarjeta</option>
                                            <option value='Mixta' selected>Mixta</option>";
                                    break;
                            }
                        ?>
                    </select>
                </div>
                <div class='col-md-2 efectivo'>
                    <h4 class="derecha">Imp. Efectivo : </h4>
                </div>
                <div class='col-md-2 efectivo'>
                    <input name="imp_efectivo" id="imp_efectivo" type='number' class='input-form'>
                </div>
                <div class='col-md-2 tarjeta'>
                    <h4 class="derecha">Imp. Tarjeta : </h4>
                </div>
                <div class='col-md-2 tarjeta'>
                    <input name="imp_tarjeta" id="imp_tarjeta" type='number' class='input-form'>
                </div>
            </div>
            <div class="row">
            <!--    <div class='col-md-2'>
                    <h4>Paga Con : </h4>
                </div>
                <div class='col-md-2'>
                    <input name="" id="" type='number' class='input-form'>
                </div>
                <div class='col-md-2'>
                    <h4>Cambio : </h4>
                </div>
                <div class='col-md-2'>
                    <input type='number' class='input-form'>
                </div>-->
                <div class="col-md-12 centrar">
                    <input type="submit" onclick="preguntar(event)" class="btn btn-outline-success btn-lg" value="Cobrar">
                </div> 
            </div>
        <?php 
            $Pagar = new mvcController();
            $Pagar -> cambiarEstadoVentaMesaController($vistaVentaM["id_venta_m"]);
        ?>
    </form>
        
    <hr>
        
    <form action="" method="post">
        <input type="hidden" name="id_venta_m_p" value="<?php echo $vistaVentaM["id_venta_m"]; ?>">
            <div class="row">
                <div class="col-md-1 derecha mb-1">
                    <p class="mt-2">Cant. : </p>
                </div>
                <div class="col-md-1 izquierda">
                    <input class="input-form" min="1" value="1" type="number" name="cant_prod_part_v_mesa" id="cant_prod_part_v_mesa">
                </div>
                <div class="col-md-4">                
                    <select class="input-form" name="id_prod_part_v_mesa" id="id_prod_part_v_mesa">
                        <?php
                            $vista = new mvcController();
                            $vista->vistaProductosSelectVentaController();
                        ?>
                    </select>
                </div>
                <div class="col-md-1 derecha mb-5">
                    <p class="mt-2">Coment. : </p>
                </div>
                <div class="col-md-3 izquierda">
                    <input class="input-form" type="text" name="comentarios_part_v_mesa" id="comentarios_part_v_mesa">
                </div>
                <div class="col-md-2">
                    <input type="submit" class="btn btn-success" value="Agregar">
                </div>
            </div>
            <?php
                $agregar = new MvcController();
                $agregar->agregarNuevaPartidaVentaMesaController();
            ?>
        </form>

    <!-- LISTA DE PRODUCTOS VENDIDOS -->
    <div class="container">
        <div class="row">
            <div class="col-md-1 tabla-partida ocultar">ID Partida</div>
            <div class="col-md-1 tabla-partida">Cant.</div>
            <div class="col-md-2 tabla-partida">Descripción</div>
            <div class="col-md-2 tabla-partida">Subtotal</div>
            <div class="col-md-3 tabla-partida">Comentarios</div>
            <div class="col-md-1 tabla-partida">Estado</div>
            <div class="col-md-1 tabla-partida">Editar</div>
            <div class="col-md-1 tabla-partida">Cancelar</div>
            <div class="col-md-1 tabla-partida">Eliminar</div>
        </div>
    </div>


<?php
            $partidas = $agregar->obtenerPartidasVentaMesaController($vistaVentaM["id_venta_m"]);
            foreach ($partidas as $key => $value) {
                echo '  <div class="row">
                            <div class="col-md-1 tabla-td-partida ocultar">'. $value["id_partida_venta_m"] .'</div>
                            <div class="col-md-1 tabla-td-partida">'. $value["cantidad_producto_partida_m"].'</div>
                            <div class="col-md-2 tabla-td-partida">'. $value["descripcion_p"].'</div>
                            <div class="col-md-2 tabla-td-partida">'. $value["subtotal_partida_m"].'</div>
                            <div class="col-md-3 tabla-td-partida">'. $value["comentarios_partida_m"].'</div>
                            <div class="col-md-1 tabla-td-partida">'. $value["estado_partida_m"].'</div>
                            <div class="col-md-1 tabla-td-partida">
                                <a href="#exampleModal">
                                    <img class="img-25" src="views/img/editar.png">
                                </a>
                            </div>
                            <div class="col-md-1 tabla-td-partida">';
                                if($value["estado_partida_m"] != 'cancelado')
                        echo    '<a href="#" onclick="cancelarPartida(this)" id="'.$value["id_partida_venta_m"].'" class="btn btn-danger" data-subtotal_p="'.$value["subtotal_partida_m"].'" data-id_venta="'.$value["id_venta_m_partida"].'" data-total_venta="'.$vistaVentaM["total_venta_m"].'">
                                    Cancelar
                                </a>';
                                elseif($value["estado_partida"] == 'cancelado')
                        echo    '<a href="#" onclick="activarPartida(this)" id="'.$value["id_partida_venta_m"].'" class="btn btn-success" data-subtotal_p="'.$value["subtotal_partida_m"].'" data-id_venta="'.$value["id_venta_m_partida"].'" data-total_venta="'.$vistaVentaM["total_venta_m"].'">
                                    Activar
                                </a>';
                    echo    '</div>
                            <div class="col-md-1 tabla-td-partida">
                                <a href="#openModalEliminar" onclick="EliminarPartida(this)" id="'.$value["id_partida_venta_m"].'" data-valor="'.$value["descripcion_p"].'" data-subtotal_p="'.$value["subtotal_partida_m"].'" data-id_venta="'.$value["id_venta_m_partida"].'" data-total_venta="'.$vistaVentaM["total_venta_m"].'">
                                    <img class="img-25" src="views/img/eliminar.png">
                                </a>
                            </div>
                        </div>';
            }
            echo '  <div class="row">
                        <div class="col-md-6 derecha total"><h4>Total de la Venta : </h4></div>
                        <div class="col-md-2 centrar total"><h4> $ '.$vistaVentaM["total_venta_m"].'</h4></div>
                        <div class="col-md-3"></div>
                    </div>';
        ?>
    </div>

    </form>
    </div>