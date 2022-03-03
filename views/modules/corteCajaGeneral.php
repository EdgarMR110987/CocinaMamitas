<script>
    $(document).ready(function(){
        $(".navbar").css("visibility","hidden");
    });
</script>

<?php
	$hora_actual = date("H");
    if(intval($hora_actual) >= 00 && intval($hora_actual) <= 07){
        $fecha_inicio = new DATETIME(date("Y-m-d 18:00:00")); // SE CREA UNA FECHA PARA PODERLE AGREGAR UN DIA
        $fecha_inicio_in = date_add($fecha_inicio, date_interval_create_from_date_string("-1 day")); // SE AGREGA UN DIA A LA FECHA DE INICIO			
        $fecha_inicio_i = $fecha_inicio_in->format("Y-m-d 18:00:00");
        $fecha_termino = date_add($fecha_inicio_in, date_interval_create_from_date_string("1 day")); // SE AGREGA UN DIA A LA FECHA DE INICIO
        $fecha_termino_b = $fecha_termino->format("Y-m-d 10:00:00"); //SE DA SALIDA DE LA FECHA DE LIMITE AGREGANDO LA HORA DE TERMINO DEL TURNO

    }else{
        $fecha_inicio_i = date("Y-m-d 18:00:00"); //SE DEFINE LA HORA DE APERTURA
        $fecha_inicio = new DATETIME(date("Y-m-d")); // SE CREA UNA FECHA PARA PODERLE AGREGAR UN DIA
        $fecha_termino = date_add($fecha_inicio, date_interval_create_from_date_string("1 day")); // SE AGREGA UN DIA A LA FECHA DE INICIO
        $fecha_termino_b = $fecha_termino->format("Y-m-d 10:00:00"); //SE DA SALIDA DE LA FECHA DE LIMITE AGREGANDO LA HORA DE TERMINO DEL TURNO      
    }
	
    $partidas = new MvcController();
    $valores = $partidas->obtenerPartidasVentasGralController();
    $parametros = new MvcController();   
    $parametro = $parametros->obtenerParametrosController();
?>

<div class="ticket">
            <img src="<?php echo $parametro["ruta_logo"]; ?>" alt="Logotipo" width="200" height="150">
            <p class="centrado">
                <br> <span style="font-weight:bold;"><?php echo $parametro["razon_social"];?></span>
                <br><?php echo $parametro["direccion"];?>
                <br><?php echo $parametro["direccion_2"];?>
                <br>
                <br>
                <span style="font-weight:bold;">CORTE DE CAJA GENERAL</span>
                <br><?php echo "Apertura : " . $fecha_inicio_i ?>
                <br><?php echo "Cierre : " . $fecha_termino_b ?>
            </p>
            <table>
                <thead>
                    <tr>
                        <th class="cantidad">Cant.</th>
                        <th class="producto">Producto</th>
                        <th class="precio">P/U</th>
                        <th class="precio">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($valores as $valor => $value){
                            echo "<tr>
                                    <td>".$value["cantidad"]."</td>
                                    <td class='fs-7'>".$value["descripcion_p"]."</td>
                                    <td>".$value["precio_venta"]."</td>
                                    <td>".$value["subtotal"]."</td>
                                </tr>";
                        }
                    ?>
                </tbody>
            </table>
            <br>
            <br>
            <center>
            <div class="row">
                    <div class="col">
                        <span>INGRESO DE SALDOS : $ <?php echo $parametros->obtenerTotalSaldosCobradosVentasClientesGralController(); ?></span>        
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <span>TOTAL COBRADO DÍA : $ <?php echo $parametros->obtenerTotalCobradoVentasClientesDiaGralController(); ?></span>        
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <span style="font-weight:bold;">TOTAL DE INGRESOS : $ <?php echo number_format($parametros->obtenerTotalSaldosCobradosVentasClientesGralController() + $parametros->obtenerTotalCobradoVentasClientesDiaGralController(),"2",".",","); ?></span>        
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <span style="font-weight:bold;">A CUENTA DEL DÍA : $ <?php echo $parametros->obtenerTotalACuentaVentasClientesGralController(); ?></span>        
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <span style="font-weight:bold; font-size:15px;">TOTAL VENTA CLIENTES : $<?php echo number_format($parametros->obtenerTotalPartidasVentasClientesGralController(),"2",".",","); ?></span>        
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <span style="font-weight:bold;">TOTAL VENTAS MESAS : $ <?php echo $parametros->obtenerTotalPartidasVentasMesasGralController(); ?></span>        
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <span style="font-weight:bold;">TOTAL GENERAL : $ <?php echo number_format($parametros->obtenerTotalSaldosCobradosVentasClientesGralController() + $parametros->obtenerTotalCobradoVentasClientesDiaGralController()+$parametros->obtenerTotalPartidasVentasMesasGralController(),"2",".",","); ?></span>        
                    </div>
                </div>
                <div class="row">
                    <div class="col p-2">
                        <span style="font-size: 40px; font-weight:bold; text-transform: uppercase;"></span>
                        <p class="centrado"><?php echo $parametro["mensaje_inferior"];?></p>  
                    </div>
                </div>
            </center>
        </div>
<script>
    $(document).ready(function(){
        $("#footer").css("visibility","hidden");
    });
</script>