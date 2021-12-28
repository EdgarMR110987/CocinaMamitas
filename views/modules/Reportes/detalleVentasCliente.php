<div class="container-fluid">
    <div class="container mt-6">
        <?php 
            $Vista = new MvcController();
            $vista = $Vista->registrosDelMesActualClienteController();
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"># Venta</th>
                    <th scope="col">Atendido Por</th>
                    <th scope="col">Forma Pago</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Total</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Tarjeta</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Pagar</th>
                </tr>
            </thead>
            <tbody id="tabla_ventas_mesas">
            <?php
                foreach ($vista as $usuario => $value) {
                    echo "<tr>
                            <td>".$value["id_venta_c"]."</td>
                            <td>".$value["vendedor"]."</td>
                            <td>".strtoupper($value["forma_pago_venta_c"])."</td>
                            <td>".$value["fecha_venta_c"]."</td>
                            <td> $ ".$value["total_venta_c"]."</td>
                            <td>
                                <span class='".$value["estado_venta_c"]."'>".strtoupper($value["estado_venta_c"])."</span>
                            </td>
                            <td>".$value["comentarios_venta_c"]."</td>
                            <td>
                                <a data-bs-toggle='modal' href='index.php?action=Ventas/editarVentaCliente&id_venta_editar=".$value["id_venta_c"]."' role='button'>
                                    <img class='img-25' src='views/img/editar.png'>
                                </a>
                            </td>";
                    if($value["estado_venta_c"] <> "pagada"){
                        echo 
                            "<td>
                                <a href='#openModalEliminar' onclick='clickactionEliminar(this)' id='".$value["id_venta_c"]."' data-valor='".$value["id_venta_c"]."'>
                                    <lord-icon src='https://cdn.lordicon.com/jvihlqtw.json' trigger='loop-on-hover' colors='primary:#30e849,secondary:#30e849' style='width:50px;height:50px'>
                                    </lord-icon>
                                </a>
                            </td>";
                    }else{
                        echo "<td></td>";
                    }
                        echo "</tr>";
                }
            ?>
            </tbody>
        </table>
    </div>
</div>