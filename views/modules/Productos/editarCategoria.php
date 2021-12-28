<?php 
    $editar = new MvcController();
    $respuesta = $editar -> editarCategoriaController();
?>

<div class="new-flotante-cuadrado uno">
    <a href="index.php?action=Productos/listadoCategorias">
        <img src="views/img/listadoCategorias.png" title="Listado Categorias">
    </a>
</div>

<div class="container mt-6">
    <h4 class="mb-3 centrar">Editar Categoria</h4>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-2 derecha mb-3">
                <span >Descripción : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">
                <input type="hidden" name="id_categoria" value="<?php echo $respuesta["id_categoria"]; ?>"> 
                <input class="input-form mayusculas" type="text" name="descripcion_cat" id="descripcion_cat" value="<?php echo $respuesta["descripcion_cat"] ?>">
            </div>
            <div class="col-md-2 derecha mb-3">
                <span>Foto : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">       
                <input id="foto_cat" class="input-form" type="file" name="foto_cat">         
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 derecha mb-3">
                <span>Vista Previa : </span>
            </div>
            <div class="col-md-4 centrar mt-4">
                <img id="img_previa" src="<?php echo $respuesta["foto_cat"];?>" alt="" class="img-previa">
            </div>
        </div>
        <!-- FILA DE BOTONOS DE AGREGAR Y LIMPIAR -->
        <div class="row">
            <div class="col mt-5 centrar">
                <input type="submit" class="btn-update" value="Actualizar">
            </div>
        </div>
    </form>
</div>
<?php 
    $editar -> actualizarCategoriaController();
?>