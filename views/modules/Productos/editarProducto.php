<script>
    $(document).ready(function(){
        $("#descripcion_p").focus();
    });
</script>

<?php 
    $editar = new MvcController();
    $respuesta = $editar -> editarProductoController();
?>

<div class="container mt-6">
    <h4 class="mb-3 centrar">Editar Producto</h4>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-2 derecha mb-3">
                <span >Descripción : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">
                <input type="hidden" name="id_producto" value="<?php echo $respuesta["id_producto"]; ?>">
                <input class="input-form mayusculas" type="text" name="descripcion_p" id="descripcion_p" value="<?php echo $respuesta["descripcion_p"]; ?>">
            </div>
            <div class="col-md-2 derecha mb-3">
                <span>Categoria : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">                
                <select class="input-form" name="id_categoria_p" id="id_categoria_p">
                    <?php
                        $vistaCategorias = new MvcController();
                        $vistaCategorias->vistaCategoriasSelectedController($respuesta["id_categoria_p"]);
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 derecha mb-3">
                <span>$ Compra : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">
                <input id="precio_compra" class="input-form" type="number" step="0.10" value="<?php echo $respuesta["precio_compra"]; ?>" name="precio_compra">
            </div>
            <div class="col-md-2 derecha mb-3">
                <span>$ Venta : </span>
            </div>
            <div class="col-md-4 izqierda mb-3">
                <input id="precio_venta" class="input-form" type="number" step="0.10" value="<?php echo $respuesta["precio_venta"]; ?>" name="precio_venta">
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 derecha mb-3">
                <span>Activo : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">
                <select class="input-form"  name="activo" id="activo">
                    <?php 
                        switch ($respuesta["activo"]) {
                            case 'S':
                                echo '  <option value="S" selected>SI</option>
                                        <option value="N">NO</option>';
                                break;
                            
                            case 'N':
                                echo '  <option value="S">SI</option>
                                        <option value="N" selected>NO</option>';
                                break;
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-2 derecha mb-3">
                <span>Foto : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">       
                <input id="foto_cat" class="input-form" type="file" name="foto_p">         
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 derecha mb-3">
                <span>$ Empleado : </span>
            </div>
            <div class="col-md-4 izqierda mb-3">
                <input id="precio_empleado" class="input-form" type="number" step="0.10" value="<?php echo $respuesta["precio_empleado"]; ?>" name="precio_empleado">
            </div>
            <div class="col-md-2 derecha mb-3">
                <span>Vista Previa : </span>
            </div>
            <div class="col-md-4 centrar mt-4">
                <img id="img_previa" src="<?php echo $respuesta["foto_p"] ?>" class="img-previa">
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
    $editar -> actualizarProductoController();
?>
