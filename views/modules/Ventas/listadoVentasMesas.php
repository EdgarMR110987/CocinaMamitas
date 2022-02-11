<div class="container mt-4">    
    <div class="row">
        <h4 class="centrar">Selecciona una Mesa . . . </h4>
        <?php
            $vista = new mvcController();
            $mesas = $vista->vistaVentasMesasPendienteController();
            foreach ($mesas as $key => $value) {
                echo    "<div class='col-md-2 mt-3'>";
                echo    "<a class='mesa btn btn-warning' href='index.php?action=Ventas/agregarProductoMesa&id_venta_m=".$value["id_venta_m"]."' style='color:white;'>".$value["id_mesa_venta_m"]."
                            <br>
                            <p class='neg mt-2 fz-17'>$".$value["total_venta_m"]."</p>
                            
                            <p class='neg mt-2 fz-17'>".$value["usuario"]."</p>
                        </a>";
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
