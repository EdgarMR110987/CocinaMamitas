<?php 
    $editar = new MvcController();
    $respuesta = $editar -> editarMesaController();
?>
<div class="container mt-6">
    <h4 class="mb-3 centrar">Editar de Mesa</h4>
    <form action="" method="post">
        <div class="row">
            <div class="col-md-2 derecha mb-3">
                <span >🔢 # de Mesa : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">
                <input type="hidden" name="id_mesa" value="<?php echo $respuesta["id_mesa"]; ?>">
                <input class="input-form" type="text" name="num_mesa" id="num_mesa" value="<?php echo $respuesta["num_mesa"] ?>">
            </div>
            <div class="col-md-2 derecha mb-3">
                <span>☑ Estado : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">                
                <select class="input-form" name="estado" id="estado">
                    <?php 
                        switch ($respuesta["estado"]) {
                            case 'libre':
                            echo '  <option value="libre" selected>Libre</option>
                                    <option value="ocupado">Ocupada</option>
                                    <option value="pagado">Pagada</option>
                                    <option value="reservado">Reservada</option>
                                    <option value="fueradeservicio">Fuera de Servicio</option>';
                                break;
                            case 'ocupado':
                                 echo ' <option value="libre">Libre</option>
                                        <option value="ocupado" selected>Ocupada</option>
                                        <option value="pagado">Pagada</option>
                                        <option value="reservado">Reservada</option>
                                        <option value="fueradeservicio">Fuera de Servicio</option>';
                                break;
                            case 'pagado':
                                 echo ' <option value="libre">Libre</option>
                                        <option value="ocupado">Ocupada</option>
                                        <option value="pagado" selected>Pagada</option>
                                        <option value="reservado">Reservada</option>
                                        <option value="fueradeservicio">Fuera de Servicio</option>';
                                break;
                            case 'reservado':
                                 echo ' <option value="libre">Libre</option>
                                        <option value="ocupado">Ocupada</option>
                                        <option value="pagado">Pagada</option>
                                        <option value="reservado" selected>Reservada</option>
                                        <option value="fueradeservicio">Fuera de Servicio</option>';
                                break;
                            case 'fueradeservicio':
                                 echo ' <option value="libre">Libre</option>
                                        <option value="ocupado">Ocupada</option>
                                        <option value="pagado">Pagada</option>
                                        <option value="reservado">Reservada</option>
                                        <option value="fueradeservicio" selected>Fuera de Servicio</option>';
                                break;
                        }
                    ?>
                   
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 derecha mb-3">
                <span>📍Ubicación : </span>
            </div>
            <div class="col-md-4 izquierda mb-3">
                <input id="ubicacion" class="input-form" type="text" name="ubicacion" value="<?php echo $respuesta["ubicacion"] ?>">
            </div>
        </div>
        <!-- FILA DE BOTONOS DE AGREGAR Y LIMPIAR -->
        <div class="row">
            <div class="col mt-4 centrar">
                <input type="submit" class="btn-update btn-lg me-3" value="Actualizar">
            </div>
        </div>
    </form>
</div>

<?php 
    $editar -> actualizarMesaController();
?>
