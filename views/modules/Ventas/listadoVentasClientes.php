<div class="new-flotante-cuadrado uno">
    <a href="index.php?action=Usuarios/altaUsuario">
        <img src="views/img/nuevo.png" alt="">
    </a>
</div>

<div class="container mt-6">
    <h4 class="mb-3 centrar">Listado Ventas a Clientes</h4>
    <table class="table">
        <thead>
            <tr>
                <th scope="col"># Venta</th>
                <th scope="col">Cliente</th>
                <th scope="col">Vendido Por</th>
                <th scope="col">Forma Pago</th>
                <th scope="col">Fecha</th>
                <th scope="col">Total</th>
                <th scope="col">Estado</th>
                <th scope="col">Comentarios</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $listado = new MvcController();
                $usuarios = $listado->vistaVentasClientesController();
                foreach ($usuarios as $usuario => $value) {
                    echo "<tr>
                            <td>".$value["id_venta_c"]."</td>
                            <td>".$value["cliente"]."</td>
                            <td>".$value["vendedor"]."</td>
                            <td>".strtoupper($value["forma_pago_venta_c"])."</td>
                            <td>".$value["fecha_venta_c"]."</td>
                            <td> $ ".$value["total_venta_c"]."</td>
                            <td>
                                <span class='".$value["estado_venta_c"]."'>".strtoupper($value["estado_venta_c"])."</span>
                            </td>
                            <td>".$value["comentarios_venta_c"]."</td>";
                            if($value["estado_venta_c"] == "pagada"){
                                echo "<td></td>";
                            }else{
                        echo "<td>
                                <a data-bs-toggle='modal' href='index.php?action=Ventas/editarVentaCliente&id_venta_editar=".$value["id_venta_c"]."' role='button'>
                                    <img class='img-25' src='views/img/editar.png'>
                                </a>
                            </td>";
                            }
                        echo "<td>
                                <a href='#openModalEliminar' onclick='clickactionEliminar(this)' id='".$value["id_venta_c"]."' data-valor='".$value["id_venta_c"]."'>
                                    <img class='img-25' src='views/img/eliminar.png'>
                                </a>
                            </td>
                          </tr>";
                }
            ?>
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
                <input type="hidden" id="link" value="index.php?action=Ventas/listadoVentasClientes">
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h6>¿Deseas Eliminar la venta : &nbsp;</h6>
                        <h6 id="os"></h6>
                        <h6 style="font-weight:bold;">&nbsp;&nbsp;¡Se eliminaran todas sus partidas!</h6>
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
    $eliminar -> borrarIdController("venta_cliente","id_venta_c", $link);
?>
</form>
