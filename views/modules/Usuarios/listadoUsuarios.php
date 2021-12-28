<div class="new-flotante-cuadrado uno">
        <a href="index.php?action=Usuarios/altaUsuario">
            <img src="views/img/nuevo.png" alt="">
        </a>
    </div>

<div class="container mt-6">
    <h4 class="mb-3 centrar">Listado de Usuarios</h4>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Usuario</th>
                <th scope="col">Contraseña</th>
                <th scope="col">Perfil</th>
                <th scope="col">Saldo</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $listado = new MvcController();
                $usuarios = $listado->vistaUsuariosController();
                foreach ($usuarios as $usuario => $value) {
                    echo "<tr>
                            <td>".$value["id_usuario"]."</td>
                            <td>".$value["usuario"]."</td>
                            <td>".$value["contrasena"]."</td>
                            <td>".$value["perfil"]."</td>
                            <td> $ ".$value["saldo_actual"]."</td>
                            <td>
                                <a data-bs-toggle='modal' href='index.php?action=Usuarios/editarUsuario&id_usuario_m=".$value["id_usuario"]."' role='button'>
                                    <img class='img-25' src='views/img/editar.png'>
                                </a>
                            </td>
                            <td>
                                <a href='#openModalEliminar' onclick='clickactionEliminar(this)' id='".$value["id_usuario"]."' data-valor='".$value["usuario"]."'>
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
                <h5 class="modal-title" id="exampleModalLabel">Borrando Usuario</h5>
                <a href="#close" title="Close" class="close">X</a>
                <input type="hidden" name="id_registro_borrar" id="id_registro_borrar">
                <input type="hidden" id="link" value="index.php?action=Usuarios/listadoUsuarios">
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>¿Deseas Eliminar el Usuario : &nbsp;</h6>
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
    $link = "index.php?action=Usuarios/listadoUsuarios";
    $eliminar -> borrarIdController("usuarios","id_usuario", $link);
?>
</form>
