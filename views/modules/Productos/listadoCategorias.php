<div class="new-flotante-cuadrado uno">
    <a href="index.php?action=Productos/altaCategoria">
        <img src="views/img/altaCategoria.png" title="Alta Categoria">
    </a>
</div>

<div class="container mt-6">
    <h4 class="mb-3 centrar">Listado de Categorias</h4>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Descripción</th>
                <th scope="col">Foto</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $listado = new MvcController();
                $usuarios = $listado->vistaCategoriasController();
                foreach ($usuarios as $usuario => $value) {
                    echo "<tr>
                            <td>".$value["id_categoria"]."</td>
                            <td>".$value["descripcion_cat"]."</td>
                            <td><img class='img-50' src='".$value["foto_cat"]."'></td>
                            <td>
                                <a data-bs-toggle='modal' href='index.php?action=Productos/editarCategoria&id_categoria_m=".$value["id_categoria"]."' role='button'>
                                    <img class='img-25' src='views/img/editar.png'>
                                </a>
                            </td>
                            <td>
                                <a href='#openModalEliminar' onclick='clickactionEliminar(this)' id='".$value["id_categoria"]."' data-valor='".$value["descripcion_cat"]."'>
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
                <input type="hidden" id="link" value="index.php?action=Productos/listadoCategorias">
            </div>
            <div class="modal-body">
                <div class="row centrar-row">
                    <div class="col-md-10">
                        <h6>¿Deseas Eliminar el producto : &nbsp;</h6>
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
    $link = "index.php?action=Productos/listadoCategorias";
    $eliminar -> borrarIdController("categorias","id_categoria", $link);
?>
</form>
