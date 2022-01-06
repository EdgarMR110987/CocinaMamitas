<?php 
$editar = new MvcController();
$respuesta = $editar -> editarUsuarioController();
?>

<div class="container mt-6">
    <h4 class="mb-3 centrar">Editar Usuario</h4>
    <form action="" method="post">
        <div class="row">
            <div class="col-md-2 derecha mb-3">
                <span >Usuario : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">
                <input type="hidden" name="id_usuario" value="<?php echo $respuesta["id_usuario"]; ?>">
                <input class="input-form" type="text" name="usuario" id="usuario" value="<?php echo $respuesta["usuario"] ?>">
            </div>
            <div class="col-md-2 derecha mb-3">
                <span>Perfil : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">                
                <select class="input-form" name="perfil" id="perfil">
                    <?php 
                        switch ($respuesta["perfil"]) {
                            case 'administrador':
                                echo '  <option value="administrador" selected>Administrador</option>
                                        <option value="cajero">Cajero</option>
                                        <option value="mesero">Mesero</option>
                                        <option value="cliente">Cliente</option>';
                                break;
                            case 'cajero':
                                echo '  <option value="administrador">Administrador</option>
                                        <option value="cajero" selected>Cajero</option>
                                        <option value="mesero">Mesero</option>
                                        <option value="cliente">Cliente</option>';
                                break;
                            case 'mesero':
                                echo '  <option value="administrador">Administrador</option>
                                        <option value="cajero">Cajero</option>
                                        <option value="mesero" selected>Mesero</option>
                                        <option value="cliente">Cliente</option>';
                                break;
                            case 'cliente':
                                echo '  <option value="administrador">Administrador</option>
                                        <option value="cajero">Cajero</option>
                                        <option value="mesero">Mesero</option>
                                        <option value="cliente" selected>Cliente</option>';
                                break;                            
                        }                    
                    ?>                  
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 derecha mb-3">
                <span>Contraseña : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">
                <input style="width:88%" id="pass1" class="input-form" type="password" name="contrasena" value="<?php echo $respuesta["contrasena"]; ?>">
                <input type="checkbox" onclick="mostrarPass1()">👁
            </div>
            <div class="col-md-2 derecha mb-3">
                <span>Repetir Contraseña : </span>
            </div>
            <div class="col-md-4 izqierda mb-3">
                <input style="width:88%" id="pass2" class="input-form" type="password" name="contrasena2" value="<?php echo $respuesta["contrasena"]; ?>">
                <input type="checkbox" onclick="mostrarPass2()">👁
            </div>
        </div>
        <?php 
        if($_SESSION["perfil"] == "administrador"){
        ?>
        <div class="row">
            <div class="col-md-2 derecha mb-3">
                <span>Saldo Actual : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">
                <input type="number" min="0" class="input-form" name="saldo_actual" id="saldo_actual" value="<?php echo $respuesta["saldo_actual"]; ?>">
            </div>
        </div>
        <!-- FILA DE BOTONOS DE AGREGAR Y LIMPIAR -->
        <div class="row">
            <div class="col mt-3 centrar">
                <input type="submit" class="btn-update" value="Actualizar">
            </div>
        </div>
    </form>
</div>
<?php 
    $editar -> actualizarUsuarioController();
}else{?>
    <div class="row">
    <div class="col mt-3 centrar">
        <input type="submit" class="btn-update" value="Actualizar">
    </div>
</div>
</form>
</div>
<?php
 $editar -> actualizarUsuarioCajeroController();
}
?>
