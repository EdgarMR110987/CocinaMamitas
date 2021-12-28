<?php 
    $buscar = new MvcController();
    $ultimoMesa = $buscar -> ultimaMesaRegistradaController();
?>

<div class="container mt-6">
    <h4 class="mb-3 centrar">Alta de Mesa</h4>
    <form action="" method="post">
        <div class="row">
            <div class="col-md-2 derecha mb-3">
                <span >🔢 # de Mesa : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">
                <input class="input-form" type="text" name="num_mesa" id="num_mesa" value="<?php echo ($ultimoMesa["id_mesa"]+1); ?>">
            </div>
            <div class="col-md-2 derecha mb-3">
                <span>☑ Estado : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">                
                <select class="input-form" name="estado" id="estado">
                    <option value="libre">Libre</option>
                    <option value="ocupado">Ocupada</option>
                    <option value="pagado">Pagada</option>
                    <option value="reservado">Reservada</option>
                    <option value="fueradeservicio">Fuera de Servicio</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 derecha mb-3">
                <span>📍Ubicación : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">
                <input id="pass1" class="input-form" type="text" name="ubicacion">
            </div>
        </div>
        <!-- FILA DE BOTONOS DE AGREGAR Y LIMPIAR -->
        <div class="row">
            <div class="col mt-4 centrar">
                <input type="submit" class="btn btn-success btn-lg me-3" value="Registrar">
                <input type="reset" class="btn btn-primary btn-lg ms-3" value="Limpiar">
            </div>
        </div>
    </form>
</div>
<?php 
$registrar = new MvcController();
$registrar -> registroMesaController();
?>