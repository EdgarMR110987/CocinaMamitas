<div class="container mt-6">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <a class="btn btn-success" href="index.php?action=Reportes/listadoVentasMesas">Ventas a Mesas</a>
        </div>
        <!--
        <div class="col-md-2">
            <a class="btn-update" href="index.php?action=Reportes/listadoVentasClientes">Ventas a Cliente</a>
        </div> 
        -->
        <div class="col-md-2">
            <a class="btn btn-danger" href="index.php?action=Reportes/listadoVentasClientes">Ventas Por Cliente</a>
        </div> 
        <div class="col-md-2">
            <a class="btn btn-info text-white" onclick="corteDelDiaMesas()">Corte Caja Mesas</a>
        </div> 
        <div class="col-md-2">
            <a class="btn-update" onclick="corteDelDiaClientes()">Corte Caja Clientes</a>
        </div> 
        <div class="col-md-2">
            <a class="btn btn-primary" onclick="corteDelDiaGral()">Corte de Caja Gral.</a>
        </div> 
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <a class="btn btn-primary fs-2 fw-bold p-4">Total Ventas del Día
            <br>
             <?php 
             $total = new MvcController();
             $respuesta = $total -> obtenerTotalVentasMesasDelDiaGralController();
             echo "$ " . number_format($respuesta["total_ventas_grl_dia"],"2",".",",");
             ?>   
            </a>
        </div>
        <div class="col-md-3">
            <a class="btn btn-secondary text-white fs-2 fw-bold p-4">Total Efectivo del Día
            <br>
             <?php 
             $total = new MvcController();
             $respuesta = $total -> obtenerTotalEnEfectivoDiaGralController();
             echo "$ " . number_format($respuesta["total_ventas_grl_dia"],"2",".",",");
             ?>   
            </a>
        </div>
        <div class="col-md-3">
            <a class="btn btn-warning text-white fs-2 fw-bold p-4">Total Tarjeta del Día
            <br>
             <?php 
             $total = new MvcController();
             $respuesta = $total -> obtenerTotalEnTarjetaDiaGralController();
             echo "$ " . number_format($respuesta["total_ventas_grl_dia"],"2",".",",");
             ?>   
            </a>
        </div>
        <div class="col-md-3">
            <a class="btn btn-dark text-white fs-2 fw-bold p-4">Total Cuenta del Día
            <br>
             <?php 
             $total = new MvcController();
             $respuesta = $total -> obtenerTotalAcuentaDiaGralController();
             echo "$ " . number_format($respuesta["total_ventas_grl_dia"],"2",".",",");
             ?>   
            </a>
        </div>
    </div>
</div>