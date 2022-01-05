<script>
    $(document).ready(function(){
        $(".navbar").css("visibility","hidden");
    });
</script>

<?php
	$fecha_inicio_i = date("Y-m-d 18:00:00"); //SE DEFINE LA HORA DE APERTURA
    $fecha_inicio = new DATETIME(date("Y-m-d")); // SE CREA UNA FECHA PARA PODERLE AGREGAR UN DIA
    $fecha_termino = date_add($fecha_inicio, date_interval_create_from_date_string("1 day")); // SE AGREGA UN DIA A LA FECHA DE INICIO
    $fecha_termino_b = $fecha_termino->format("Y-m-d 17:00:00"); //SE DA SALIDA DE LA FECHA DE LIMITE AGREGANDO LA HORA DE TERMINO DEL TURNO  
    $partidas = new MvcController();
    $valores = $partidas->obtenerPartidasVentasMesasGralController();
    $parametros = new MvcController();   
    $parametro = $parametros->obtenerParametrosController();
?>

<div class="ticket">
            <img src="<?php echo $parametro["ruta_logo"]; ?>" alt="Logotipo" width="200" height="150">
            <p class="centrado">
                <br><?php echo $parametro["razon_social"];?>
                <br>
                <br>
                <span style="font-weight:bold;">CORTE DE CAJA A MESAS</span>
                <br><?php echo "A : - " . $fecha_inicio_i ?>
                <br><?php echo "C : - " . $fecha_termino_b ?>
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
                        <span style="font-weight:bold;">TOTAL VENTAS MESAS : $ <?php echo $parametros->obtenerTotalPartidasVentasMesasGralController(); ?></span>        
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