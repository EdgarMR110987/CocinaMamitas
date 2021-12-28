<div class="container mt-6">
    <h4 class="mb-3 centrar">Listado Ventas a Clientes</h4>
    <div class="row justify-content-center">
    <?php 
        $Clientes = new MvcController();
        $clientes = $Clientes->vistaClientesController();
        foreach ($clientes as $cliente => $value) { ?>
                <div class="col-md-3 btn-success m-3 p-3 centrar">
                    <a class="text-decoration-none text-light" href="index.php?action=Reportes/detalleVentasCliente&id_cliente_venta_c=<?php echo $value["id_usuario"];?>">
                        <h3><?php echo $value["usuario"]; ?></h3>
                        <br>
                        <h3><?php echo "$ " . $value["saldo_actual"]; ?></h3>
                    </a>
                </div>
        <?php } ?>
    </div>
</div>