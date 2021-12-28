<form action="" method="post">
    <div class="container">
        <div>
            <div class="col-md-6">
                <img src="views/img/Cubo.png" class="ico-login">
                <h1 class="centrar">ACCESO COCINA MAMITAS</h1>
            </div>
            <div class="col-md-6 pt-10">
                <label for="usuario" class="form-label">Usuario</label>
            </div>
            <div class="col-md-6 centrar">
                <input type="text" max-length="10" class="form-control" name="usuario_i" id="usuario_i" aria-describedby="emailHelp">
            </div>
            <div class="col-md-6">
                <label for="contrasena" class="form-label">Password</label>
            </div>
            <div class="col-md-6 centrar">    
                <input type="password" class="form-control" id="contrasena" name="contrasena">
            </div>
            <div class="col-md-6 centrar pt-10">
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </div>
        </div>
    </div>
</form>

<?php
    $ingreso =  new MvcController();
    $ingreso -> ingresoUsuarioController();
?>