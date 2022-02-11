<div class="container mt-6">
    <h4 class="mb-3 centrar">Listado Ventas a Mesas</h4>
    
    <div class="row pb-3">
        <div class="col-md-4 derecha">Buscar Por : </div>
        <div class="col-md-5">
            <select name="buscar_por" id="buscar_por" class="input-form">
                <option value="" disabled selected>Selecciona una opcion</option>
                <option value="estado_venta_m">Estado Venta</option>
                <option value="forma_pago_m">Forma de Pago</option>
                <option value="num_mesa">Mesa</option>
                <option value="fecha_venta_m">Rango de Fechas</option>
            </select>
        </div>
        <div class="col-md-3"></div>
    </div>

    <div class="row" style="display:none;" id="estado_venta_m">
        <div class="col-md-4 derecha">Estado Venta : </div>
        <div class="col-md-5">
            <select name="estado_venta_m" id="v_estado_venta_m" class="input-form">
                <option value="abierta">Abierta</option>
                <option value="pagada">Pagada</option>
                <option value="cancelada">Cancelada</option>
            </select>
        </div>
        <div class="col-md-3"></div>
    </div>

    <div class="row" style="display:none;" id="forma_pago_m">
        <div class="col-md-4 derecha">Forma de Pago : </div>
        <div class="col-md-5">
            <select name="forma_pago_m" id="v_forma_pago_m" class="input-form">
                <option value="Efectivo">Efectivo</option>
                <option value="Tarjeta">Tarjeta</option>
                <option value="Mixta">Mixta</option>
            </select>
        </div>
        <div class="col-md-3"></div>
    </div>

    <div class="row" style="display:none;" id="num_mesa">
        <div class="col-md-4 derecha">Mesa : </div>
        <div class="col-md-5">
            <select name="id_mesa_venta_m" id="v_id_mesa_venta_m" class="input-form">
                <?php 
                    $mesas = new MvcController();
                    $mesas -> vistaMesasSelectController();
                ?>            
            </select>
        </div>
        <div class="col-md-3"></div>
    </div>

    <div class="row" style="display:none;" id="fecha_venta_m">
        <div class="col-md-1"></div>
        <div class="col-md-2 derecha">Fecha Inicio: </div>
        <div class="col-md-3">
            <input type="date" name="" id="v_fecha_venta_m_i" class="input-form">
        </div>
        <div class="col-md-2 derecha">Fecha Final: </div>
        <div class="col-md-3">
            <input type="date" name="" id="v_fecha_venta_m_f" class="input-form">
        </div>
        <div class="col-md-1"></div>
    </div>

    <div class="row centrar pt-2">
        <div class="col-md">
            <input type="button" id="btn_buscar" class="btn btn-success" value="BUSCAR">
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col"># Venta</th>
                <th scope="col">Atendido Por</th>
                <th scope="col">Mesa</th>
                <th scope="col">Forma Pago</th>
                <th scope="col">Fecha</th>
                <th scope="col">Total</th>
                <th scope="col">Estado</th>
                <th scope="col">Efectivo</th>
                <th scope="col">Tarjeta</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody id="tabla_ventas_mesas">
            <?php 
                $listado = new MvcController();
                $usuarios = $listado->vistaVentasMesasController();
                foreach ($usuarios as $usuario => $value) {
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
                                <a data-bs-toggle='modal' href='index.php?action=Ventas/agregarProductoMesa&id_venta_m=".$value["id_venta_m"]."' role='button'>
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
            ?>
            <tr>
                <td colspan="7" class="pt-3 derecha"><h5>TOTAL DE VENTAS : </h5></td>
                <td colspan="4" class="pt-3 izquierda"><h5> $ <?php  $listado->totalVentasMesaController("pagada"); ?></h5></td>
            </tr>
        </tbody>
    </table>
</div>

 <!-- MODAL PARA ELIMINAR -->
 <form class="form" action="" method="post">
    <div id="openModalEliminar" class="modalDialog">
        <div class="preguntar">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Borrando Venta</h5>
                <a href="#close" title="Close" class="close">X</a>
                <input type="hidden" name="id_registro_borrar" id="id_registro_borrar">
                <input type="hidden" id="link" value="index.php?action=Productos/listadoCategorias">
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>¿Deseas Eliminar la venta : &nbsp;</h6>
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
    $link = "index.php?action=Ventas/listadoVentasClientes";
    $eliminar -> borraridController("venta_cliente","id_venta_c", $link);
?>
</form>
