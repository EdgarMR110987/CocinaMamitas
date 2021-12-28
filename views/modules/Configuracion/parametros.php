<?php
$parametros = new MvcController();
$valores = $parametros->obtenerParametrosController();
if ($valores == false) {
?>
    <div class="container mt-6">
        <div class="container-fluid cont-param p-5">
            <div class="row pb-3 centrar">
                <h4>Registrar</h4>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row p-2">
                    <div class="col-2 derecha">
                        <span>Razón Social : </span>
                    </div>
                    <div class="col-4">
                        <input name="razon_social" type="text" class="input-form" placeholder="Cocina Mamitas SA de CV">
                    </div>
                    <div class="col-2 derecha">
                        <span>Dirección : </span>
                    </div>
                    <div class="col-4">
                        <input name="direccion" type="text" maxlength="30" class="input-form" placeholder="Avenida de la Reforma 10, Col.">
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-2 derecha">
                        <span>Dirección 2 : </span>
                    </div>
                    <div class="col-4">
                        <input name="direccion_2" type="text" maxlength="30" class="input-form" placeholder="Nuevo Leon, Cuatlancingo, Pue, 72706">
                    </div>
                    <div class="col-2 derecha">
                        <span>Mensaje Inferior : </span>
                    </div>
                    <div class="col-4">
                        <input name="mensaje_inferior" type="text" maxlength="30" class="input-form" placeholder="¡Gracias por su compra!">
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-2 derecha">
                        <span>Logotipo : </span>
                    </div>
                    <div class="col-4">
                        <input class="input-form" type="file" name="ruta_logo" id="foto_cat">
                    </div>
                    <div class="col-2 derecha">
                        <span>Vista Previa :</span>
                    </div>
                    <div class="col-4 centrar">
                        <img class="img-100" src="" alt="" srcset="" id="img_previa">
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-6 derecha">
                        <input type="submit" value="Guardar" class="btn btn-success">
                    </div>
                    <div class="col-6">
                        <input type="reset" value="Limpiar" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php 
        $registrar = new MvcController();
        $registrar -> altaParametrosController();
} else { 
  
    ?>

    <div class="container mt-6">
        <div class="container-fluid cont-param p-5">
            <div class="row pb-3 centrar">
                <h4>Actualizar</h4>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="row p-2">
                <div class="col-2 derecha">
                    <span>Razón Social : </span>
                </div>
                <div class="col-4">
                    <input name="razon_social" type="text" class="input-form" value="<?php echo $valores["razon_social"]; ?>">
                </div>
                <div class="col-2 derecha">
                    <span>Dirección : </span>
                </div>
                <div class="col-4">
                    <input name="direccion" type="text" maxlength="30" class="input-form" value="<?php echo $valores["direccion"]; ?>">
                </div>
            </div>
            <div class="row p-2">
                <div class="col-2 derecha">
                    <span>Dirección 2 : </span>
                </div>
                <div class="col-4">
                    <input name="direccion_2" type="text" maxlength="30" class="input-form" value="<?php echo $valores["direccion_2"]; ?>">
                </div>
                <div class="col-2 derecha">
                    <span>Mensaje Inferior : </span>
                </div>
                <div class="col-4">
                    <input name="mensaje_inferior" type="text" maxlength="30" class="input-form" value="<?php echo $valores["mensaje_inferior"]; ?>">
                </div>
            </div>
            <div class="row p-2">
                <div class="col-2 derecha">
                    <span>Logotipo : </span>
                </div>
                <div class="col-4">
                    <input class="input-form" type="file" name="ruta_logo" id="foto_cat">
                </div>
                <div class="col-2 derecha">
                    <span>Vista Previa :</span>
                </div>
                <div class="col-4 centrar">
                    <img class="img-100" src="<?php echo $valores["ruta_logo"] ?>" id="img_previa">
                </div>
            </div>
            <div class="row p-2">
                <div class="col-6 derecha">
                    <input type="submit" value="Guardar" class="btn btn-success">
                </div>
                <div class="col-6">
                    <input type="reset" value="Limpiar" class="btn btn-primary">
                </div>
            </div>
</form>
        </div>
    </div>
<?php  
    $registrar = new MvcController();
    $registrar -> actualizarParametrosController(); 
} 
?>