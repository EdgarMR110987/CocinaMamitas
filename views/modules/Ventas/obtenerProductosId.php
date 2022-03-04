<?php
include('conexiondb.php');
$consulta = "SELECT p.id_producto, p.precio_venta, p.descripcion_p, p.foto_p, c.id_categoria
             FROM productos p 
             LEFT JOIN categorias c ON c.id_categoria = p.id_categoria_p
             WHERE p.id_categoria_p = " . $_POST['id_categoria'] . "
             ORDER BY id_producto ASC";
if ($resultado = $con->query($consulta)) {  
    /* obtener el array de objetos */    
    while ($fila = $resultado->fetch_row()) { 
        $id_producto = $fila[0];                    
        $precio_venta = $fila[1];
        $descripcion_p = $fila[2];
        $foto_p =  $fila[3];
        $id_categoria = $fila[4];

        echo    "<a class='hand' data-id_prod='$id_producto'  data-precio='$precio_venta' onclick='return agregarProductoVenta(this);'>
                    <div class='card m-1 tarjeta'>
                        <img class='card-img-top' src='". $foto_p. "'>
                        <div class='card-body text-center'>
			  				<p class='card-title fs-8'>". $descripcion_p ." / $ ". $precio_venta ."</p>
						</div>
		  			</div>
                </a>";
    }   
    echo    "<a href='' onclick='reload()'>
                <div class='card m-1 tarjeta'>
                    <img class='card-img-top' src='views/img/Regresar.png'>
                    <div class='card-body text-center'>
                        <p class='card-title fs-8'>REGRESAR</p>
                    </div>
                </div>
            </a>";
    /* liberar el conjunto de resultados */
    $resultado->close();
}
/* cerrar la conexi贸n */
$con->close();
?>