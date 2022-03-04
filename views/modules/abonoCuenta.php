<script>
    $(document).ready(function(){
        $(".navbar").css("visibility","hidden");
    });
</script>
<?php 
$array_venta = (array)json_decode(base64_decode($_GET["array_venta"]));
$array_importes = (array)json_decode(base64_decode($_GET["array_importes"]));
$array_abonos = (array)json_decode(base64_decode($_GET["array_abonos"]));

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
                <span style="font-weight:bold;">ABONO A CUENTA</span>
                <br><?php echo "Fecha Abono : " . date("d-m-Y H:i:s") ?>
            </p>
            <table>
                <thead>
                    <tr>
                        <th class="cantidad"># Vta</th>
                        <th class="precio">Fecha</th>
                        <th class="precio">Importe</th>
                        <th class="precio">Pagado</th>
                        <th class="precio">Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i =0;
                        foreach($array_venta as $valor){
                            echo "<tr>
                                    <td class='fs-7'>".$valor."</td>
                                    <td class='fs-7'>". $parametros->obtenerFechaVentaClienteController($valor) ."</td>
                                    <td class='fs-7'>".$array_importes[$i]."</td>
                                    <td class='fs-7'>".number_format($array_abonos[$i],2)."</td>";
                                    if($parametros->obtenerNvoSaldoVentaClienteController($valor) != ""){
                                        echo "<td class='fs-7'>".number_format(($parametros->obtenerNvoSaldoVentaClienteController($valor) - $array_abonos[$i] ),2)."</td>";
                                    }else{
                                        echo "<td class='fs-7'>".number_format(($array_importes[$i] - $array_abonos[$i] ),2)."</td>";
                                    }
                                echo "</tr>";
                                $i++;
                        }
                    ?>
                </tbody>
            </table>
            <br>
            <center>
                <hr>
                <div class="row">
                    <div class="col">
                        <span style="font-weight:bold;">TOTAL PAGADO : $ <?php echo number_format(array_sum($array_abonos),2,".",".") ?></span>        
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <span style="font-weight:bold;">SALDO CLIENTE : $ <?php echo number_format($parametros->obtenerSaldoClienteController(base64_decode($_GET["id_usuario"])),2,".",","); ?></span>        
                    </div>
                </div>
                <hr>
               
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