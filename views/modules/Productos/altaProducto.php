<script>
    $(document).ready(function(){
        $("#descripcion_p").focus();
    });
</script>
<div class="container mt-6">
    <h4 class="mb-3 centrar">Alta de Producto</h4>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-2 derecha mb-3">
                <span >Descripción : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">
                <input class="input-form mayusculas" type="text" name="descripcion_p" id="descripcion_p" placeholder="Nombre del producto">
            </div>
            <div class="col-md-2 derecha mb-3">
                <span>Categoria : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">                
                <select class="input-form" name="id_categoria_p" id="id_categoria_p">
                    <?php
                        $vistaCategorias = new MvcController();
                        $vistaCategorias->vistaCategoriasSelectController();
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 derecha mb-3">
                <span>$ Compra : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">
                <input id="precio_compra" class="input-form" type="number" step="0.10" placeholder="0.00" name="precio_compra">
            </div>
            <div class="col-md-2 derecha mb-3">
                <span>$ Venta : </span>
            </div>
            <div class="col-md-4 izqierda mb-3">
                <input id="precio_venta" class="input-form" type="number" step="0.10" placeholder="0.00" name="precio_venta">
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 derecha mb-3">
                <span>Activo : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">
                <select class="input-form"  name="activo" id="activo">
                    <option value="" disabled selected>Selecciona SI/NO . . . </option>
                    <option value="S">SI</option>
                    <option value="N">NO</option>
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
                <span>Vista Previa : </span>
            </div>
            <div class="col-md-4 centrar mt-4">
                <img id="img_previa" src="" alt="" class="img-previa">
            </div>
        </div>
        <!-- FILA DE BOTONOS DE AGREGAR Y LIMPIAR -->
        <div class="row">
            <div class="col mt-5 centrar">
                <input type="submit" class="btn btn-success" value="Registrar">
                <input type="reset" class="btn btn-primary" value="Limpiar">
            </div>
        </div>
    </form>
</div>
<?php 
$registrar = new MvcController();
$registrar -> registroProductoController();
?>