<style>
    .navbar{
        justify-content: center;
    }
</style>

<div class="container-fluid">
    <div class="container mt-6">
        <?php 
            $Vista = new MvcController();
            $vista = $Vista->registrosVentasClienteController();
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
                    <th scope="col">Imprimir</th>
                    <th scope="col">Detalle</th>
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
                            <td>
                                <a data-bs-toggle='modal' href='index.php?action=Ventas/editarVentaCliente&id_venta_editar=".$value["id_venta_c"]."' role='button'>
                                    <img class='img-25' src='views/img/imprimir.gif'>
                                </a>
                            <td>
                                <a data-bs-toggle='modal' href='index.php?action=Clientes/detalleVentaCliente&id_venta_editar=".$value["id_venta_c"]."' role='button'>
                                    <img class='img-25' src='views/img/detalle.gif'>
                                </a>
                            </td>
                        </tr>";
                }
            ?>
            </tbody>
        </table>
    </div>
</div>