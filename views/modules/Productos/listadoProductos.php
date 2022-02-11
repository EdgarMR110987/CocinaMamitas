<script>
    $(document).ready(function(){
        var modal = document.getElementById('popUp');
        var img = document.getElementById('myImg');
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        
        $('.img-50').click(function(){
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        });
   
        $('.close-img-modal').click(function(){
            modal.style.display = "none";
        });

})
</script>

<div class="new-flotante-cuadrado uno">
    <a href="index.php?action=Productos/altaProducto">
        <img src="views/img/nuevo.png" title="Alta Producto">
    </a>
</div>
<div class="new-flotante-cuadrado dos">
    <a href="index.php?action=Productos/altaCategoria">
        <img src="views/img/altaCategoria.png" title="Alta Categoria" >
    </a>
</div>
<div class="new-flotante-cuadrado tres">
    <a href="index.php?action=Productos/listadoCategorias">
        <img src="views/img/listadoCategorias.png" title="Listado Categorias">
    </a>
</div>
    
<div class="container mt-6">
    <h4 class="mb-3 centrar">Listado de Producto</h4>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Descripción</th>
                <th scope="col">Categoria</th>
                <th scope="col">$ Compra</th>
                <th scope="col">$ Venta</th>
                <th scope="col">$ Empleado</th>
                <th scope="col">Foto</th>
                <th scope="col">Activo</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody>
         
            <?php 
                $listado = new MvcController();
                $usuarios = $listado->vistaProductosController();
                foreach ($usuarios as $usuario => $value) {
                    echo "<tr>
                            <td>".$value["id_producto"]."</td>
                            <td>".$value["descripcion_p"]."</td>
                            <td>".$value["descripcion_cat"]."</td>
                            <td> $ ".$value["precio_compra"]."</td>
                            <td> $ ".$value["precio_venta"]."</td>
                            <td> $ ".$value["precio_empleado"]."</td>
                            <td>
                                <img id='myImg' class='img-50' src='".$value["foto_p"]."'>
                            </td>";
                            if($value["activo"] == "S"){
                                echo "<td><span class='SI'>&nbspSI&nbsp</span></td>";
                            }else{
                                echo "<td><span class='NO'>NO</span></td>";
                            }
                        echo "<td>
                                <a data-bs-toggle='modal' href='index.php?action=Productos/editarProducto&id_producto_m=".$value["id_producto"]."' role='button'>
                                    <img class='img-25' src='views/img/editar.png'>
                                </a>
                            </td>
                            <td>
                                <a href='#openModalEliminar' onclick='clickactionEliminar(this)' id='".$value["id_producto"]."' data-valor='".$value["descripcion_p"]."'>
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
                <h5 class="modal-title" id="exampleModalLabel">Borrando Producto</h5>
                <a href="#close" title="Close" class="close">X</a>
                <input type="hidden" name="id_registro_borrar" id="id_registro_borrar">
                <input type="hidden" id="link" value="index.php?action=Productos/listadoProductos">
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>¿Deseas Eliminar el Producto : &nbsp;</h6>
                        <h6 id="os"></h6>
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
    $link = "index.php?action=Productos/listadoProductos";
    $eliminar -> borrarIdController("productos","id_producto", $link);
?>
</form>

<div id="popUp" class="modal">
  <span class="close-img-modal">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>