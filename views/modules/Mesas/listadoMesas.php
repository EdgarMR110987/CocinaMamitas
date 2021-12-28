<div class="new-flotante-cuadrado uno">
        <a href="index.php?action=Mesas/altaMesa">
            <img src="views/img/nuevo.png" alt="">
        </a>
    </div>

<div class="container mt-6">
    <h4 class="mb-3 centrar">Listado de Mesas</h4>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" style="ocultar">Id</th>
                <th scope="col"># Mesa</th>
                <th scope="col">Ubicación</th>
                <th scope="col">Estado</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $listado = new MvcController();
                $usuarios = $listado->vistaMesasController();
                foreach ($usuarios as $usuario => $value) {
                    echo "<tr>
                            <td>".$value["id_mesa"]."</td>
                            <td>".$value["num_mesa"]."</td>
                            <td>".$value["ubicacion"]."</td>
                            <td class='".$value["estado"]."'>";
                            if( $value["estado"] == "fueradeservicio")
                                echo "FUERA DE SERVICIO";
                            else
                                echo strtoupper($value["estado"]);
                            echo "</td>
                            <td>
                                <a data-bs-toggle='modal' href='index.php?action=Mesas/editarMesa&id_mesa_m=".$value["id_mesa"]."' role='button'>
                                    <img class='img-25' src='views/img/editar.png'>
                                </a>
                            </td>
                            <td>
                                <a href='#openModalEliminar' onclick='clickactionEliminar(this)' id='".$value["id_mesa"]."' data-valor='".$value["num_mesa"]."'>
                                    <img class='img-25' src='views/img/eliminar.png'>
                                </a>
                            </td>
                          </tr>";
                }
            ?>
        </tbody>
    </table>
</div>

 <!-- MODAL PARA ELIMINAR -->
 <form class="form" action="" method="post">
    <div id="openModalEliminar" class="modalDialog">
        <div class="preguntar">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Borrando Mesa</h5>
                <a href="#close" title="Close" class="close">X</a>
                <input type="hidden" name="id_registro_borrar" id="id_registro_borrar">
                <input type="hidden" id="link" value="index.php?action=Mesas/listadoMesas">
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>¿Deseas Eliminar la Mesa : &nbsp;</h6>
                        <h6 id="os"></h6>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cerrar-modal">Salir</button>
                <input class="btn btn-danger" type="submit" value="ELIMINAR">
            </div>
        </div>
    </div>


<!-- TERMINA EL MODAL PARA ELIMINAR -->

<?php 
    $eliminar = new MvcController();
    $link = "index.php?action=Mesas/listadoMesas";
    $eliminar -> borrarIdController("mesas","id_mesa", $link);
?>
</form>
