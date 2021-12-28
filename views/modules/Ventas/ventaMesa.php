<div class="container mt-6">
    <div class="row centrar">
        <h4 class="centrar">Estados</h4>
        <div class="col-md-2">
            <div class="btn btn-primary">Libre</div>
        </div>
        <div class="col-md-2">
            <div class="btn btn-warning" style="color:white;">Ocupado</div>
        </div>
        <div class="col-md-2">
            <div class="btn btn-success">Pagado</div>
        </div>
        <div class="col-md-3">
            <div class="btn btn-danger">Fuera de Servicio</div>
        </div>
        <div class="col-md-2">
            <div class="btn btn-secondary">Reservado</div>
        </div>        
    </div>
</div>
<hr>

<div class="container">    
    <div class="row">
        <h4 class="centrar">Selecciona una Mesa . . . </h4>
        <?php
            $vista = new mvcController();
            $mesas = $vista->vistaMesasController();
            foreach ($mesas as $key => $value) {
                echo "  <div class='col-md-2 mt-3'>";
                    switch($value["estado"]){
                        case "libre":
                            echo   "<a class='mesa btn btn-primary' href='#openModalEliminar' onclick='clickactionEliminar(this)' data-valor='".$value["num_mesa"]."' id='".$value["id_mesa"]."'>".$value["num_mesa"]."</a>";
                        break;
                        case "ocupado":
                            $datos_venta = new mvcController();
                            $datos = $datos_venta->vistaVentaMesaDatoController($value["id_mesa"]);
                            echo   "<a class='mesa btn btn-warning' href='index.php?action=Ventas/agregarProductoMesa&id_venta_m=".$datos["id_venta_m"]."' style='color:white;'>".$value["num_mesa"]."<br><p class='neg mt-2 fz-17'>$".$datos["total_venta_m"]."</p></a>";
                        break;
                        case "pagado":
                            echo   "<a class='mesa btn btn-success'>".$value["num_mesa"]."</a>
                                    <p> $ </p>";
                        break;
                        case "fueradeservicio":
                            echo   "<a class='mesa btn btn-danger'>".$value["num_mesa"]."</a>";
                        break;
                        case "reservado":
                            echo   "<a class='mesa btn btn-secondary'>".$value["num_mesa"]."</a>";
                        break;
                    }
                          
                echo    "</div>";
            }
        ?>
    </diV>
</diV>


 <!-- MODAL PARA ELIMINAR -->
 <form class="form" action="" method="post">
    <div id="openModalEliminar" class="modalDialog">
        <div class="preguntar">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Nueva Venta</h5>
                <a href="#close" title="Close" class="close">X</a>
                <input type="hidden" name="id_registro_borrar" id="id_registro_borrar">
                <input type="hidden" id="link" value="index.php?action=Ventas/ventaMesa">
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6" style="width:100%">
                        <h6>¿Deseas abrir una nueva venta para la mesa &nbsp;</h6>
                        <h6 id="os"></h6>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cerrar-modal">Salir</button>
                <input class="btn btn-success" type="submit" value="Registrar">
            </div>
        </div>
    </div>
    <?php
        $vista->registroVentaMesaController();
    ?>
</form>
