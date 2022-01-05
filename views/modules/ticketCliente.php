<script>
    $(document).ready(function(){
        $(".navbar").css("visibility","hidden");
    });
</script>

<?php
    $partidas = new MvcController();
    $valores = $partidas->obtenerPartidasVentaClienteTicketController($_GET["id_venta_c"]);
    $parametros = new MvcController();   
    $parametro = $parametros->obtenerParametrosController();
    $ventas = new MvcController();   
    $venta = $ventas->vistaVentaClienteTicketController($_GET["id_venta_c"]);
?>

<div class="ticket">
            <img src="<?php echo $parametro["ruta_logo"]; ?>" alt="Logotipo" width="200" height="150">
            <p class="centrado">
                <br><span style="font-weight:bold;"><?php echo $parametro["razon_social"];?></span>
                <br><?php echo $parametro["direccion"];?>
                <br><?php echo $parametro["direccion_2"];?>
                <br>
                <br><?php echo "Fecha : " . $venta["fecha_venta_c"];?><br>
                   <span style="font-weight:bold;"># Cliente : <?php echo $venta["cliente"]; ?> -  # Venta : <?php echo $_GET["id_venta_c"] ?></span>
                   <br><span style="font-weight:bold;"> Mesero : <?php echo $venta["mesero"]; ?> </span>                   
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
                <?php if($venta["forma_pago_venta_c"] <> "Mixta"){?>
                    <div class="row">
                        <div class="col p-2">
                            <span style="font-weight:bold;">FORMA DE PAGO : <?php echo strtoupper($venta["forma_pago_venta_c"]); ?></span>
                        </div>
                    </div>
                <?php }else{?>
                    <div class="row">
                        <div class="col p-2">
                            <span style="font-weight:bold;">FORMA DE PAGO : <?php echo strtoupper($venta["forma_pago_venta_c"]); ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col p-2">
                            <span style="font-weight:bold;">EFECTIVO : $<?php echo  number_format($venta["imp_efectivo"],2,'.',','); ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col p-2">
                            <span style="font-weight:bold;">TARJETA : $<?php echo  number_format($venta["imp_tarjeta"],2,'.',','); ?></span>
                        </div>
                    </div>
                <?php }?>
                <div class="row">
                    <div class="col">
                        <span style="font-weight:bold;">TOTAL : $ <?php echo number_format($venta["total_venta_c"],2,'.',','); ?></span>        
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