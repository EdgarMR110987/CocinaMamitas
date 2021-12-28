<div class="container mt-6">
    <h4 class="mb-3 centrar">Alta de Usuario</h4>
    <form action="" method="post">
        <div class="row">
            <div class="col-md-2 derecha mb-3">
                <span >Usuario : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">
                <input class="input-form" type="text" name="usuario" id="usuario" placeholder="Escribe el usuario de acceso">
            </div>
            <div class="col-md-2 derecha mb-3">
                <span>Perfil : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">                
                <select class="input-form" name="perfil" id="perfil">
                    <option value="administrador">Administrador</option>
                    <option value="cajero">Cajero</option>
                    <option value="mesero">Mesero</option>
                    <option value="mesero">Cliente</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 derecha mb-3">
                <span>Contraseña : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">
                <input id="pass1" class="input-form" type="password" name="contrasena">
            </div>
            <div class="col-md-2 derecha mb-3">
                <span>Repetir Contraseña : </span>
            </div>
            <div class="col-md-4 izqierda mb-3">
                <input id="pass2" class="input-form" type="password" name="contrasena2">
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 derecha mb-3">
                <span>Saldo Actual : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">
                <input type="number" min="0" value="0" class="input-form" name="saldo_actual" id="saldo_actual">
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
$registrar -> registroUsuarioController();
?>