<?php
require_once "./models/crud.php";

class MvcController
{

	#LLAMADA A LA PLANTILLA JAES
	#-------------------------------------
	public function pagina()
	{
		include "views/template.php";
	}

	#ENLACES JAES
	#-------------------------------------
	public function enlacesPaginasController()
	{
		if (isset($_GET['action'])) {
			$enlaces = $_GET['action'];
		} else {
			$enlaces = "index";
		}
		$respuesta = Paginas::enlacesPaginasModel($enlaces);
		include $respuesta;
	}

	#ENLACES DE LOS CLIENTES PARA SU ACCESO
	#----------------------------------------
	public function enlacesPaginasClienteController(){
		if (isset($_GET['action'])) {
			$enlaces = $_GET['action'];
		} else {
			$enlaces = "index";
		}
		$respuesta = Paginas::enlacesPaginasClienteModel($enlaces);
		include $respuesta;
	}
	

	#REGISTRO DE USUARIOS
	#------------------------------------
	public static function registroUsuarioController()
	{
		if (isset($_POST["usuario"])) {
			$datosController = array(
				"usuario" => $_POST["usuario"],
				"contrasena" => $_POST["contrasena"],
				"perfil" => $_POST["perfil"],
				"saldo_actual" => $_POST["saldo_actual"]
			);
			$respuesta = Datos::registroUsuarioModel($datosController, "usuarios");
			$url = "index.php?action=Usuarios/listadoUsuarios";
			if ($respuesta == "success") {
				echo "<script>
                        registroOK('" . $url . "');
                    </script>";
			} else {
				echo "<script> 
                            errorRegistro('" . $respuesta[2] . "','" . $url . "');
                    </script>";
			}
		}
	}

	#INGRESO DE USUARIOS
	#------------------------------------
	public static function ingresoUsuarioController()
	{
		if (isset($_POST["usuario_i"])) {
			$datosController = array(
				"usuario" => $_POST["usuario_i"],
				"contrasena" => $_POST["contrasena"]
			);
			$respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");
			if (password_verify($_POST["contrasena"], $respuesta["password"])) {
				$_SESSION["autentificado"] = "SI";
				$_SESSION["id_usuario"] = $respuesta["id_usuario"];
				$_SESSION["usuario"] = $respuesta["usuario"];
				$_SESSION["perfil"] = $respuesta["perfil"];
				$_SESSION["saldo_actual"] = $respuesta["saldo_actual"];
				$_SESSION["timeout"] = time();
				if($_SESSION["perfil"] == "cliente"){
					echo "<script>
							bienvenidaCliente('" . $respuesta["usuario"] . "');
						</script>";
				}else{
					echo "<script>
							bienvenida('" . $respuesta["usuario"] . "');
						</script>";
				}
			} else {
				echo "<script>errorAcceso();</script>";
			}
		}
	}

	#VISTA DE USUARIOS
	#------------------------------------

	public static function vistaUsuariosController()
	{
		$respuesta = Datos::vistaGeneralTablaModel("usuarios");
		return $respuesta;
	}

	#VISTA DE USUARIOS CON PERFIL DE MESERO
	#------------------------------------

	public static function vistaUsuariosMeseroController()
	{
		$respuesta = Datos::vistaUsuariosMeseroModel("usuarios","mesero");
		echo "<option value='' selected disabled>Selecciona una mesero . . . </option>";
		foreach ($respuesta as $value) {
			echo "<option value='" . $value["id_usuario"] . "'>" . $value["usuario"] . "</option>";
		}
	}

	#BORRAR USUARIO
	#------------------------------------
	public static function borrarRegistroController($tabla, $columna, $link)
	{
		if (isset($_POST["id_registro_borrar"])) {
			$datosController = $_POST["id_registro_borrar"];
			$respuesta = Datos::borrarFilaModel($datosController, $tabla, $columna);
			$datosControllerUpdate = array(
				"id_venta" => $_POST["id_venta"],
				"subtotal_p" => $_POST["subtotal_p"],
				"total_venta" => $_POST["total_venta"],
			);
			$act_total_venta = Datos::actualizar_venta_mesa_Model($datosControllerUpdate);
			if ($respuesta == "success") {
				echo '<script>
                var x = document.getElementById("openModalEliminar");
                x.style.display = "none";             
                borrarOk(' . "'" . $link . "'" . ');
                </script>';
			} else {
				$valor = $respuesta[2];
				$error = str_replace("'", "", $valor);
				echo '<script>
                        var x = document.getElementById("openModalEliminar");
                        x.style.display = "none";              
                        errorBorrado(' . "'" . $error . "','" . $link . "'" . ');
                </script>';
			}
		}
	}

	#EDITAR USUARIO
	#------------------------------------
	public static function editarUsuarioController()
	{
		$datosController = $_GET["id_usuario_m"];
		$respuesta = Datos::editarGeneralModel($datosController, "usuarios", "id_usuario");
		return $respuesta;
	}

	#ACTUALIZAR USUARIO PERFIL ADMINISTRADOR
	#------------------------------------
	public static function actualizarUsuarioController(){
		if (isset($_POST["id_usuario"])) {
			$datosController = array(
				"id_usuario" => $_POST["id_usuario"],
				"usuario" => $_POST["usuario"],
				"perfil" => $_POST["perfil"],
				"contrasena" => $_POST["contrasena"],
				"saldo_actual" => $_POST["saldo_actual"]
			);
			$respuesta = Datos::actualizarUsuarioModel($datosController, "usuarios");
			$url = "index.php?action=Usuarios/listadoUsuarios";
			if ($respuesta == "success") {
				echo "<script>
                        actualizarOK('" . $url . "');
                    </script>";
			} else {
				echo "<script> 
                        errorRegistro('" . $respuesta[2] . "','" . $url . "');
                    </script>";
			}
		}
	}

#ACTUALIZAR USUARIO PERFIL ADMINISTRADOR
	#------------------------------------
	public static function actualizarUsuarioCajeroController(){
		if (isset($_POST["id_usuario"])) {
			$datosController = array(
				"id_usuario" => $_POST["id_usuario"],
				"usuario" => $_POST["usuario"],
				"contrasena" => $_POST["contrasena"]);
			$respuesta = Datos::actualizarUsuarioCajeroModel($datosController, "usuarios");
			$url = "index.php?action=Usuarios/listadoUsuarios";
			if ($respuesta == "success") {
				echo "<script>
                        actualizarOK('" . $url . "');
                    </script>";
			} else {
				echo "<script> 
                        errorRegistro('" . $respuesta[2] . "','" . $url . "');
                    </script>";
			}
		}
	}

	

	#REGISTRO DE MESA
	#------------------------------------
	public static function registroMesaController()
	{
		if (isset($_POST["num_mesa"])) {
			$datosController = array(
				"num_mesa" => $_POST["num_mesa"],
				"ubicacion" => $_POST["ubicacion"],
				"estado" => $_POST["estado"]
			);
			$respuesta = Datos::registroMesaModel($datosController, "mesas");
			$url = "index.php?action=Mesas/listadoMesas";
			if ($respuesta == "success") {
				echo "<script>
                        registroOK('" . $url . "');
                    </script>";
			} else {
				echo "<script> 
                            errorRegistro('" . $respuesta[2] . "','" . $url . "');
                    </script>";
			}
		}
	}

	#VISTA DE MESAS PENDIENTES
	#------------------------------------

	public static function vistaVentasMesasPendienteController()
	{
		$respuesta = Datos::vistaVentasMesasPendienteModel("venta_mesa","abierta");
		return $respuesta;
	}

	#VISTA DE MESAS SELECT
	#------------------------------------

	public static function vistaMesasSelectController()
	{
		$respuesta = Datos::vistaGeneralTablaModel("mesas");
		echo "<option value='' selected disabled>Selecciona una mesa . . . </option>";
		foreach ($respuesta as $value) {
			echo "<option value='" . $value["id_mesa"] . "'>" . $value["num_mesa"] . "</option>";
		}
	}


	#EDITAR MESA
	#------------------------------------
	public static function editarMesaController()
	{
		$datosController = $_GET["id_mesa_m"];
		$respuesta = Datos::editarGeneralModel($datosController, "mesas", "id_mesa");
		return $respuesta;
	}

	#ACTUALIZAR MESA 
	#------------------------------------
	public static function actualizarMesaController()
	{
		if (isset($_POST["id_mesa"])) {
			$datosController = array(
				"id_mesa" => $_POST["id_mesa"],
				"num_mesa" => $_POST["num_mesa"],
				"ubicacion" => $_POST["ubicacion"],
				"estado" => $_POST["estado"]
			);
			$respuesta = Datos::actualizarMesaModel($datosController, "mesas");
			$url = "index.php?action=Mesas/listadoMesas";
			if ($respuesta == "success") {
				echo "<script>
						registroOK('" . $url . "');
					</script>";
			} else {
				echo "<script>
						errorRegistro('" . $respuesta[2] . "','" . $url . "');
					</script>";
			}
		}
	}


	#VISTA DE CATEGORIAS PARA UN SELECT
	#------------------------------------

	public static function vistaCategoriasSelectedController($id_categoria)
	{
		$respuesta = Datos::vistaGeneralTablaModel("categorias");
		foreach ($respuesta as $value) {
			if ($id_categoria == $value["id_categoria"])
				echo "<option value='" . $value["id_categoria"] . "' selected>" . $value["descripcion_cat"] . "</option>";
			else
				echo "<option value='" . $value["id_categoria"] . "'>" . $value["descripcion_cat"] . "</option>";
		}
	}

	#REGISTRO DE CATEGORIA NUEVA
	#------------------------------------
	public static function registroCategoriaController()
	{
		if (isset($_POST["descripcion_cat"])) {
			if ($_FILES['foto_cat']['name'] == null) {
				$ruta_archivo = null;
			} else {
				$info = new SplFileInfo($_FILES['foto_cat']['name']);
				$ruta_archivo = "fotos/" . $_POST['descripcion_cat'] . '.' . $info->getExtension();
				move_uploaded_file($_FILES["foto_cat"]["tmp_name"], $ruta_archivo);
			}
			$datosController = array(
				"descripcion_cat" => strtoupper($_POST["descripcion_cat"]),
				"foto_cat" => $ruta_archivo
			);
			$respuesta = Datos::registroCategoriaModel($datosController, "categorias");
			$url = "index.php?action=Productos/listadoCategorias";
			if ($respuesta == "success") {
				echo "<script>
                        registroOK('" . $url . "');
                    </script>";
			} else {
				echo "<script> 
                            errorRegistro('" . $respuesta[2] . "','" . $url . "');
                    </script>";
			}
		}
	}

	#VISTA DE CATEGORIAS
	#------------------------------------

	public static function vistaCategoriasController()
	{
		$respuesta = Datos::vistaGeneralTablaModel("categorias");
		return $respuesta;
	}


	#VISTA DE CATEGORIAS PARA UN SELECT
	#------------------------------------

	public static function vistaCategoriasSelectController()
	{
		$respuesta = Datos::vistaGeneralTablaModel("categorias");
		echo "<option value='' selected disabled>Selecciona una categoria . . . </option>";
		foreach ($respuesta as $value) {
			echo "<option value='" . $value["id_categoria"] . "'>" . $value["descripcion_cat"] . "</option>";
		}
	}

	#EDITAR CATEGORIA
	#------------------------------------
	public static function editarCategoriaController()
	{
		$datosController = $_GET["id_categoria_m"];
		$respuesta = Datos::editarGeneralModel($datosController, "categorias", "id_categoria");
		return $respuesta;
	}

	#ACTUALIZAR CATEGORIA
	#------------------------------------
	public static function actualizarCategoriaController()
	{
		if (isset($_POST["id_categoria"])) {
			$url = "index.php?action=Productos/listadoCategorias";
			if ($_FILES['foto_cat']['name'] == null) {
				$datosController = array(
					"id_categoria" => $_POST["id_categoria"],
					"descripcion_cat" => strtoupper($_POST["descripcion_cat"])
				);
				$respuesta = Datos::actualizarCategoriaSFotoModel($datosController, "categorias");
				if ($respuesta == "success") {
					echo "<script>registroOK('" . $url . "');</script>";
				} else {
					echo "<script>errorRegistro('" . $respuesta[2] . "','" . $url . "');</script>";
				}
			} else {
				$info = new SplFileInfo($_FILES['foto_cat']['name']);
				$ruta_archivo = "fotos/Productos/" . $_POST["descripcion_cat"] . '.' . $info->getExtension();
				move_uploaded_file($_FILES["foto_cat"]["tmp_name"], $ruta_archivo);
				$datosController = array(
					"id_categoria" => $_POST["id_categoria"],
					"descripcion_cat" => strtoupper($_POST["descripcion_cat"]),
					"foto_cat" => $ruta_archivo
				);
				$respuesta = Datos::actualizarCategoriaCFotoModel($datosController, "categorias");
				if ($respuesta == "success") {
					echo "<script>registroOK('" . $url . "');</script>";
				} else {
					echo "<script>errorRegistro('" . $respuesta[2] . "','" . $url . "');</script>";
				}
			}
		}
	}


	#REGISTRO DE PRODUCTO NUEVO
	#------------------------------------
	public static function registroProductoController()
	{
		if (isset($_POST["descripcion_p"])) {
			if ($_FILES['foto_p']['name'] == null) {
				$ruta_archivo = null;
			} else {
				$info = new SplFileInfo($_FILES['foto_p']['name']);
				$ruta_archivo = "fotos/Productos/" . $_POST['descripcion_p'] . '.' . $info->getExtension();
				move_uploaded_file($_FILES["foto_p"]["tmp_name"], $ruta_archivo);
			}
			$datosController = array(
				"descripcion_p" => strtoupper($_POST["descripcion_p"]),
				"id_categoria_p" => $_POST["id_categoria_p"],
				"precio_compra" => $_POST["precio_compra"],
				"precio_venta" => $_POST["precio_venta"],
				"precio_empleado" => $_POST["precio_empleado"],
				"activo" => $_POST["activo"],
				"foto_p" => $ruta_archivo
			);
			$respuesta = Datos::registroProductoModel($datosController, "productos");
			$url = "index.php?action=Productos/listadoProductos";
			if ($respuesta == "success") {
				echo "<script>
                        registroOK('" . $url . "');
                    </script>";
			} else {
				echo "<script> 
                            errorRegistro('" . $respuesta[2] . "','" . $url . "');
                    </script>";
			}
		}
	}

	#VISTA DE PRODUCTOS
	#------------------------------------
	public static function vistaProductosController()
	{
		$respuesta = Datos::vistaProductoTablaModel("productos");
		return $respuesta;
	}

	#EDITAR PRODUCTO
	#------------------------------------
	public static function editarProductoController()
	{
		$datosController = $_GET["id_producto_m"];
		$respuesta = Datos::editarGeneralModel($datosController, "productos", "id_producto");
		return $respuesta;
	}

	#ACTUALIZAR PRODUCTO
	#----------------------------------------------------------------------------------------
	public static function actualizarProductoController()
	{
		if (isset($_POST["id_producto"])) {
			$url = "index.php?action=Productos/listadoProductos";
			if ($_FILES['foto_p']['name'] == null) {
				$datosController = array(
					"id_producto" => $_POST["id_producto"],
					"descripcion_p" => strtoupper($_POST["descripcion_p"]),
					"id_categoria_p" => $_POST["id_categoria_p"],
					"precio_compra" => $_POST["precio_compra"],
					"precio_venta" => $_POST["precio_venta"],
					"precio_empleado" => $_POST["precio_empleado"],
					"activo" => $_POST["activo"]
				);
				$respuesta = Datos::actualizarProductoSFotoModel($datosController, "productos");
				if ($respuesta == "success") {
					echo "<script>actualizarOK('" . $url . "');</script>";
				} else {
					echo "<script>errorRegistro('" . $respuesta[2] . "','" . $url . "');</script>";
				}
			} else {
				$info = new SplFileInfo($_FILES['foto_p']['name']);
				$ruta_archivo = "fotos/Productos/" . $_POST["descripcion_p"] . '.' . $info->getExtension();
				move_uploaded_file($_FILES["foto_p"]["tmp_name"], $ruta_archivo);
				$datosController = array(
					"id_producto" => $_POST["id_producto"],
					"descripcion_p" => strtoupper($_POST["descripcion_p"]),
					"foto_p" => $ruta_archivo,
					"id_categoria_p" => $_POST["id_categoria_p"],
					"precio_compra" => $_POST["precio_compra"],
					"precio_venta" => $_POST["precio_venta"],
					"precio_empleado" => $_POST["precio_empleado"],
					"activo" => $_POST["activo"]
				);
				$respuesta = Datos::actualizarProductoCFotoModel($datosController, "productos");
				if ($respuesta == "success") {
					echo "<script>actualizarOK('" . $url . "');</script>";
				} else {
					echo "<script>errorRegistro('" . $respuesta[2] . "','" . $url . "');</script>";
				}
			}
		}
	}

	#VISTA DE CLIENTES PARA UN SELECT
	#------------------------------------

	public static function vistaClientesSelectController()
	{
		$respuesta = Datos::vistaClientesModel("usuarios");
		echo "<option value='' selected disabled>Selecciona un cliente . . . </option>";
		foreach ($respuesta as $value) {
			echo "<option value='" . $value["id_usuario"] . "' data-saldo='" . $value["saldo_actual"] . "'>" . $value["usuario"] . "</option>";
		}
	}

	#VISTA DE CLIENTES PARA UN SELECT, INDICANDO EL SELECTED
	#------------------------------------

	public static function vistaClientesSelectedController($id_cliente)
	{
		$respuesta = Datos::vistaClientesModel("usuarios");
		foreach ($respuesta as $value) {
			if ($id_cliente == $value["id_usuario"])
				echo "<option value='" . $value["id_usuario"] . "' data-saldo='" . $value["saldo_actual"] . "' selected>" . $value["usuario"] . "</option>";
			else
				echo "<option value='" . $value["id_usuario"] . "' data-saldo='" . $value["saldo_actual"] . "'>" . $value["usuario"] . "</option>";
		}
	}

	#VISTA CLIENTES GENERAL
	#----------------------------
	public static function vistaClientesController()
	{
		$respuesta = Datos::vistaClientesModel("usuarios");
		return $respuesta;
	}

	#REGISTRO DE NUEVA VENTA A CLIENTES
	#------------------------------------
	public static function registroVentaClienteController()
	{
		if (isset($_POST["id_cliente_venta_c"])) {
			switch ($_POST["forma_pago_venta_c"]) {
				case 'cuenta':
					$estado_venta_c = "pendiente";
					break;
				default:
					$estado_venta_c = "pagada";
					break;
			}
			$datosController = array(
				"id_cliente_venta_c" => $_POST["id_cliente_venta_c"],
				"id_usuario_venta_c" => $_SESSION["id_usuario"],
				"forma_pago_venta_c" => $_POST["forma_pago_venta_c"],
				"fecha_venta_c" => $_POST["fecha_venta_c"],
				"comentarios_venta_c" => $_POST["comentarios_venta_c"],
				"estado_venta_c" => $estado_venta_c
			);
			$respuesta = Datos::registroVentaClienteModel($datosController, "venta_cliente");
			$url = "index.php?action=Ventas/agregarProductoVentaCliente";
			if ($respuesta == "success") {
				echo "<script>
                        registroOK('" . $url . "');
                    </script>";
			} else {
				echo "<script> 
                            errorRegistro('" . $respuesta[2] . "','" . $url . "');
                    </script>";
			}
		}
	}

	#VISTA ULTIMA VENTA A CLIENTE PARA AGREGARLE LOS PRODUCTOS 
	#------------------------------------

	public static function vistaUltimaVentaClienteController()
	{
		$respuesta = Datos::vistaUltimaVentaClienteModel("venta_cliente");
		return $respuesta;
	}

	#VISTA DE VENTAS A CLIENTES 
	#------------------------------------

	public static function vistaVentasClientesController()
	{
		$respuesta = Datos::vistaVentasClientesModel("venta_cliente");
		return $respuesta;
	}

	#VISTA DE VENTAS A MESAS 
	#------------------------------------

	public static function vistaVentasMesasController(){
		$respuesta = Datos::vistaVentasMesasModel("venta_mesa");
		return $respuesta;
	}

	public static function editarVentaClienteController()
	{
		if (isset($_GET["id_venta_editar"])) {
			$respuesta = Datos::editarGeneralModel($_GET["id_venta_editar"], "venta_cliente", "id_venta_c");
			return $respuesta;
		}
	}

	public static function obtenerPartidasVentaClienteController($id_venta_c)
	{
		$respuesta = Datos::vistaPartidasVentaClienteModel($id_venta_c, "partida_venta_c");
		return $respuesta;
	}

	public static function vistaProductosSelectVentaController()
	{
		$respuesta = Datos::vistaGeneralTablaModel("productos");
		foreach ($respuesta as $key => $value) {
			echo '<option value="' . $value["id_producto"] . '">' . $value["descripcion_p"] . '</option>';
		}
	}

	#REGISTRO DE USUARIOS
	#------------------------------------
	public static function agregarPartidaVentaController()
	{
		if (isset($_POST["cant_partida_v"])) {
			$datos = array("id_producto" => $_POST["id_prod_venta"]);
			$precio_unitario = Datos::obtenerPrecioProductoModel("productos", $datos);
			$sub_total_venta = ($precio_unitario["precio_venta"] * $_POST["cant_partida_v"]);

			$datosController = array(
				"cant_partida_v" => $_POST["cant_partida_v"],
				"id_prod_venta" => $_POST["id_prod_venta"],
				"id_venta_agregar_p" => $_POST["id_venta_agregar_p"],
				"sub_total_venta" => $sub_total_venta,
				"comentarios_partida" => $_POST["comentarios_partida"]
			);

			$respuesta = Datos::insertarPartidaVentaModel($datosController, "partida_venta_c");

			$total = Datos::obtenerTotalVentaClienteModel($_POST["id_venta_agregar_p"]);
			$nvo_total = ($total["total_venta_c"] + $sub_total_venta);
			$datosUpdate = array("total_venta" => $nvo_total, "id_venta" => $_POST["id_venta_agregar_p"]);
			$actualizarTotal = Datos::actualizarVentaClienteModel($datosUpdate);

			$url = "index.php?action=Ventas/editarVentaCliente&id_venta_editar=" . $_POST["id_venta_agregar_p"];

			if ($actualizarTotal == "success") {

				echo "<script>
                        registroOK('" . $url . "');
                    </script>";
			} else {
				echo "<script> 
                            errorRegistro('" . $respuesta[2] . "','" . $url . "');
                    </script>";
			}
		}
	}


	#REGISTRO DE PARTIDA NUEVA A VENTA DE CLIENTE
	#------------------------------------
	public static function agregarNuevaPartidaVentaController()
	{
		if (isset($_POST["cant_partida_v"])) {
			$datos = array("id_producto" => $_POST["id_prod_venta"]);
			$precio_unitario = Datos::obtenerPrecioProductoModel("productos", $datos);
			if($_POST["perfil"] == "cliente"){
				$sub_total_venta = ($precio_unitario["precio_venta"] * $_POST["cant_partida_v"]);
			}else{
				$sub_total_venta = ($precio_unitario["precio_empleado"] * $_POST["cant_partida_v"]);
			}
			if($_POST["estado_venta_c"] == "pagada")
				$estado_partida = "pagada";
			else
				$estado_partida = "pendiente";
			$datosController = array(
				"cant_partida_v" => $_POST["cant_partida_v"],
				"id_prod_venta" => $_POST["id_prod_venta"],
				"id_venta_agregar_p" => $_POST["id_venta_agregar_p"],
				"sub_total_venta" => $sub_total_venta,
				"estado_partida" => $estado_partida,
				"comentarios_partida" => $_POST["comentarios_partida"]
			);

			$respuesta = Datos::insertarPartidaVentaModel($datosController, "partida_venta_c");

			$total = Datos::obtenerTotalVentaClienteModel($_POST["id_venta_agregar_p"]);
			$estado_venta_cliente = $total["forma_pago_venta_c"];
			$id_cliente_venta_c = $total["id_cliente_venta_c"];
			if($estado_venta_cliente == "cuenta"){
				$saldo_anterior = Datos::editarUsuarioModel($id_cliente_venta_c, "usuarios");
				$nvo_saldo = ($saldo_anterior["saldo_actual"] + $sub_total_venta);
				$datosUpdate = array("saldo_actual" => $nvo_saldo, "id_usuario" => $id_cliente_venta_c);
				$actualizarTotal = Datos::actualizarSaldoClienteModel($datosUpdate);
			}
			$nvo_total = ($total["total_venta_c"] + $sub_total_venta);
			$datosUpdate = array("total_venta" => $nvo_total, "id_venta" => $_POST["id_venta_agregar_p"]);
			$actualizarTotal = Datos::actualizarVentaClienteModel($datosUpdate);

			$url = "index.php?action=Ventas/agregarProductoVentaCliente";

			if ($actualizarTotal == "success") {
				echo "<script>
                        registroOK('" . $url . "');
                    </script>";
			} else {
				echo "<script> 
                            errorRegistro('" . $actualizarTotal[2] . "','" . $url . "');
                    </script>";
			}
		}
	}

	#REGISTRO DE NUEVA VENTA A UNA MESA
	#------------------------------------
	public static function registroVentaMesaController()
	{
		if (isset($_POST["id_usuario_venta_m"])) {
			$datosController = array(
				"id_usuario_venta_m" => $_POST["id_usuario_venta_m"],
				"id_mesa_venta_m" => $_POST["id_mesa_venta_m"],
				"forma_pago_m" => $_POST["forma_pago_m"],
				"fecha_venta_m" => $_POST["fecha_venta_m"]

			);
			$respuesta = Datos::registroVentaMesaModel($datosController, "venta_mesa");
			$url = "index.php?action=Ventas/agregarProductoMesa&id_venta_m=" . $respuesta["id_venta_m"];
			if (isset($respuesta["id_venta_m"])) {
				echo '<script>
						var x = document.getElementById("openModalEliminar");
						x.style.display = "none";    
                        registroOK(' . "'" . $url . "'" . ');
                    </script>';
			} else {
				echo '<script> 
							var x = document.getElementById("openModalEliminar");
							x.style.display = "none";    
                            errorRegistro(' . "'" . $respuesta[2] . "','" . $url . "'" . ');
                    </script>';
			}
		}
	}


	#VISTA DE LOS DATOS DE UNA VENTA DE UNA MESA
	#------------------------------------

	public static function vistaVentaMesaController()
	{
		if (isset($_GET["id_venta_m"])) {
			$respuesta = Datos::vistaVentaMesaModel($_GET["id_venta_m"], "venta_mesa");
			return $respuesta;
		}
	}

	public static function nombreUsuarioController($id_usuario)
	{
		$respuesta = Datos::nombreUsuarioModel($id_usuario, "usuarios");
		echo $respuesta["usuario"];
	}


	#REGISTRO DE PARTIDA NUEVA A VENTA DE MESA
	#------------------------------------
	public static function agregarNuevaPartidaVentaMesaController()
	{
		if (isset($_POST["cant_prod_part_v_mesa"])) {
			$datos = array("id_producto" => $_POST["id_prod_part_v_mesa"]);
			$precio_unitario = Datos::obtenerPrecioProductoModel("productos", $datos);
			$sub_total_venta = ($precio_unitario["precio_venta"] * $_POST["cant_prod_part_v_mesa"]);

			$datosController = array(
				"cant_prod_part_v_mesa" => $_POST["cant_prod_part_v_mesa"],
				"id_prod_part_v_mesa" => $_POST["id_prod_part_v_mesa"],
				"id_venta_m" => $_POST["id_venta_m_p"],
				"sub_total_venta" => $sub_total_venta,
				"comentarios_part_v_mesa" => $_POST["comentarios_part_v_mesa"]
			);

			$respuesta = Datos::insertarPartidaVentaMesaModel($datosController, "partida_venta_m");

			$total = Datos::obtenerTotalVentaMesaModel($_POST["id_venta_m_p"]);
			$nvo_total = ($total["total_venta_m"] + $sub_total_venta);
			$datosUpdate = array("total_venta_m" => $nvo_total, "id_venta_m" => $_POST["id_venta_m_p"]);
			$actualizarTotal = Datos::actualizarVentaMesaModel($datosUpdate);

			$url = "index.php?action=Ventas/agregarProductoMesa&id_venta_m=" . $_POST["id_venta_m_p"];

			if ($respuesta == "success") {

				echo "<script>
                        registroOK('" . $url . "');
                    </script>";
			} else {
				echo "<script> 
                            errorRegistro('" . $respuesta[2] . "','" . $url . "');
                    </script>";
			}
		}
	}

	#OBTENER TODAS LAS PARTIDAS DE LA VENTA A UNA MESA
	public static function obtenerPartidasVentaMesaController($id_venta_m)
	{
		$respuesta = Datos::vistaPartidasVentaMesaModel($id_venta_m, "partida_venta_m");
		return $respuesta;
	}

	public static function cambiarEstadoVentaMesaController()
	{
		if (isset($_POST["id_venta_m"])) {
			$datosController = array(
				"id_venta_m" => $_POST["id_venta_m"],
				"estado_venta_m" => "pagada",
				"forma_pago_m" => $_POST["forma_pago_mesa"],
				"total_venta_m" => $_POST["total_venta_m"],
				"imp_efectivo" => $_POST["imp_efectivo"],
				"imp_tarjeta" => $_POST["imp_tarjeta"]
			);
			$respuesta = Datos::cambiarEstadoVentaMesaModel($datosController, "venta_mesa");
			$datosController2 = array(
				"id_mesa" => $_POST["id_mesa_venta_m"],
				"estado" => "libre"
			);
			$respuesta2 = Datos::cambiarEstadoMesaModel($datosController2, "mesas");
			$url = "index.php?action=Ventas/ventaMesa";
			if ($respuesta == "success" && $respuesta2 == "success") {
				echo "<script>
					ventanaNueva();
					registroOK('" . $url . "');
				</script>";
			}
		}
	}

	#VISTA DE LOS DATOS DE UNA VENTA DE UNA MESA PASANDO ID MESA
	#------------------------------------
	public static function vistaVentaMesaDatoController($id_venta_m)
	{
		$respuesta = Datos::vistaVentaMesaDatoModel($id_venta_m, "venta_mesa");
		return $respuesta;
	}

	#BORRAR UN REGISTRO DE UN ID ESPECIFICO INDICANDO EL NOMBRE DE LA COLUMNA Y LA TABLA
	#--------------------------
	public static function borrarIdController($tabla, $campo, $link)
	{
		if (isset($_POST["id_registro_borrar"])) {
			$respuesta = Datos::borrarFilaModel($_POST["id_registro_borrar"], $tabla, $campo);
			if ($respuesta == "success") {
				echo '<script>
						var x = document.getElementById("openModalEliminar");
						x.style.display = "none";    
						borrarOk(' . "'" . $link . "'" . ');
					</script>';
			} else {
				echo '<script> 
						var x = document.getElementById("openModalEliminar");
						x.style.display = "none";    
						errorRegistro(' . "'" . $respuesta[2] . "','" . $link . "'" . ');
					</script>';
			}
		}
	}

	public static function ultimaMesaRegistradaController()
	{
		$respuesta = Datos::ultimaMesaRegistradaModel("mesas");
		return $respuesta;
	}

	public static function totalVentasMesaController($estado)
	{
		$respuesta = Datos::totalVentasMesaModel("venta_mesa", $estado);
		echo $respuesta["total_ventas_mesas"];
	}

	public static function registrosDelMesActualClienteController()
	{
		if (isset($_GET["id_cliente_venta_c"])) {
			$respuesta = Datos::registrosDelMesActualClienteModel("venta_cliente", $_GET["id_cliente_venta_c"]);
			return $respuesta;
		}
	}

	public static function obtenerParametrosController()
	{
		$respuesta = Datos::obtenerParametrosModel();
		return $respuesta;
	}

	public static function altaParametrosController()
	{
		if (isset($_POST["razon_social"])) {
			if ($_FILES['ruta_logo']['name'] == null) {
				$ruta_archivo = null;
			} else {
				$info = new SplFileInfo($_FILES['ruta_logo']['name']);
				$ruta_archivo = "fotos/" . $_POST['razon_social'] . '.' . $info->getExtension();
				move_uploaded_file($_FILES["ruta_logo"]["tmp_name"], $ruta_archivo);
			}
			$datosController = array(
				"razon_social" => $_POST["razon_social"],
				"direccion" => $_POST["direccion"],
				"direccion_2" => $_POST["direccion_2"],
				"mensaje_inferior" => $_POST["mensaje_inferior"],
				"ruta_logo" => $ruta_archivo);
			$respuesta = Datos::altaParametrosModel($datosController, "parametros");
			$url = "index.php?action=Configuracion/parametros";
			if ($respuesta == "success") {
				echo "<script>
						registroOK('" . $url . "');
					</script>";
			} else {
				echo "<script> 
						errorRegistro('" . $respuesta[2] . "','" . $url . "');
					</script>";
			}
		}
	}

	//ACTUALIZAR PARAMETROS DEL SISTEMA
	public static function actualizarParametrosController()
	{
		if (isset($_POST["razon_social"])) {
			if ($_FILES['ruta_logo']['name'] == null) {
				$datosController = array(
					"razon_social" => $_POST["razon_social"],
					"direccion" => $_POST["direccion"],
					"direccion_2" => $_POST["direccion_2"],
					"mensaje_inferior" => $_POST["mensaje_inferior"]
				);
				$respuesta = Datos::actualizarParametrosSFotoModel($datosController, "parametros");
				$url = "index.php?action=Configuracion/parametros";
				if ($respuesta == "success") {
					echo "<script>
							actualizarOK('" . $url . "');
						</script>";
				} else {
					echo "<script> 
							errorRegistro('" . $respuesta[2] . "','" . $url . "');
						</script>";
				}
			} else {
				$info = new SplFileInfo($_FILES['ruta_logo']['name']);
				$ruta_archivo = "fotos/" . $_POST['razon_social'] . '.' . $info->getExtension();
				move_uploaded_file($_FILES["ruta_logo"]["tmp_name"], $ruta_archivo);
				$datosController = array(
					"razon_social" => $_POST["razon_social"],
					"direccion" => $_POST["direccion"],
					"direccion_2" => $_POST["direccion_2"],
					"mensaje_inferior" => $_POST["mensaje_inferior"],
					"ruta_logo" => $ruta_archivo
				);
				$respuesta = Datos::actualizarParametrosCFotoModel($datosController, "parametros");
				$url = "index.php?action=Configuracion/parametros";
				if ($respuesta == "success") {
					echo "<script>
							actualizarOK('" . $url . "');
						</script>";
				} else {
					echo "<script> 
							errorRegistro('" . $respuesta[2] . "','" . $url . "');
						</script>";
				}
			}
		}
	}

	#OBTENER TODAS LAS PARTIDAS DE LA VENTA A UNA MESA PARA EL TICKET
	public static function obtenerPartidasVentaMesaTicketController($id_venta_m){
		$respuesta = Datos::vistaPartidasVentaMesaTicketModel($id_venta_m, "partida_venta_m");
		return $respuesta;
	}
	
	#OBTENER DATOS DE LA VENTA A UNA MESA PARA EL TICKET
	public static function vistaVentaMesaTicketController($id_venta_m){
		$respuesta = Datos::vistaVentaMesaTicketModel($id_venta_m, "venta_mesa");
		return $respuesta;
	}

	#OBTENER TODAS LAS PARTIDAS DE LA VENTA A UNA MESA PARA EL TICKET
	public static function obtenerPartidasVentaClienteTicketController($id_venta_c){
		$respuesta = Datos::vistaPartidasVentaClienteTicketModel($id_venta_c, "partida_venta_c");
		return $respuesta;
	}

	#OBTENER TODAS LAS PARTIDAS DE LA VENTA A UNA MESA PARA EL TICKET
	public static function obtenerNombreClienteIdController($id_cliente_venta_c){
		$respuesta = Datos::obtenerNombreClienteIdModel($id_cliente_venta_c, "usuarios");
		return $respuesta;
	}

	#OBTENER DATOS DE LA VENTA A UNA MESA PARA EL TICKET
	public static function vistaVentaClienteTicketController($id_venta_c){
		$respuesta = Datos::vistaVentaClienteTicketModel($id_venta_c, "venta_cliente");
		return $respuesta;
	}
	
	##METODO PARA OBTENER LAS PARTIDAS DE LAS VENTAS A MESAS DEL DIA 
	#-----------------------------------------------
	public static function obtenerPartidasVentasMesasGralController(){
		$respuesta = Datos::obtenerPartidasVentasMesasGralModel("partida_venta_m");
		return $respuesta;
	}

	##METODO PARA OBTENER LAS PARTIDAS DE LAS VENTAS A MESAS DEL DIA 
	#-----------------------------------------------
	public static function obtenerTotalPartidasVentasMesasGralController(){
		$respuesta = Datos::obtenerTotalPartidasVentasMesasGralModel("partida_venta_m");
		return $respuesta["total"];
	}
	
	#METODO PARA COBRAR UNA VENTA A CUENTA DE UN CLIENTE
	#SE ACTUALIZA EL SALDO DEL CLIENTE
	#--------------------------------------------------------------------------
	public static function cobrarVentaClienteController($tabla, $url){
		if(isset($_POST["id_venta_cobrar"])){
			$datosControllerVenta = array("id_venta_c" => $_POST["id_venta_cobrar"]);
			$respuesta = Datos::actualizarEstadoVentaClientePagadaModel($tabla, $datosControllerVenta);

			$saldo_anterior = Datos::editarUsuarioModel($_POST["id_usuario"], "usuarios");
			$nvo_saldo = ($saldo_anterior["saldo_actual"] - $_POST["total_venta"]);
			$datosUpdate = array("saldo_actual" => $nvo_saldo, "id_usuario" => $_POST["id_usuario"]);
			$actualizarTotal = Datos::actualizarSaldoClienteModel($datosUpdate);
			if ($respuesta == "success") {
				echo '<script>
						var x = document.getElementById("openModalPagar");
						x.style.display = "none";    
						actualizarOK(' . "'" . $url . "'" . ');
					  </script>';
			} else {
				echo '<script> 
						var x = document.getElementById("openModalPagar");
						x.style.display = "none";   
						errorRegistro(' . "'" . $respuesta[2] . "','" . $url . "'" . '); 
					</script>';
			}
		}
	}


	##METODO PARA OBTENER LAS PARTIDAS DE LAS VENTAS A MESAS DEL DIA 
	#-----------------------------------------------
	public static function obtenerPartidasVentasClientesGralController(){
		$respuesta = Datos::obtenerPartidasVentasClientesGralModel("partida_venta_c");
		return $respuesta;
	}
	
	#METODO PARA OBTENER LAS PARTIDAS DE LAS VENTAS A CLIENTES DEL DIA
	#-----------------------------------------------
	public static function obtenerTotalPartidasVentasClientesGralController(){
		$respuesta = Datos::obtenerTotalPartidasVentasClientesGralModel("partida_venta_c");
		return $respuesta["total"];
	}

	#METODO PARA OBTENER EL TOTAL DE LO QUE SE LES COBRO A LOS CLIENTES DE CUENTAS PASADAS
	#-----------------------------------------------
	public static function obtenerTotalSaldosCobradosVentasClientesGralController(){
		$respuesta = Datos::obtenerTotalSaldosCobradosVentasClientesGralModel("partida_venta_c");
		return $respuesta["total"];
	}

	#METODO PARA OBTENER EL TOTAL DE LO QUE SE LES COBRO A LOS CLIENTES DE CUENTAS PASADAS
	#-----------------------------------------------
	public static function obtenerTotalCobradoVentasClientesDiaGralController(){
		$respuesta = Datos::obtenerTotalCobradoVentasClientesDiaGralModel("partida_venta_c");
		return $respuesta["total"];
	}

	#METODO PARA OBTENER EL TOTAL DE LO QUE SE LES COBRO A LOS CLIENTES DE CUENTAS PASADAS
	#-----------------------------------------------
	public static function obtenerTotalACuentaVentasClientesGralController(){
		$respuesta = Datos::obtenerTotalACuentaVentasClientesGralModel("partida_venta_c");
		return number_format($respuesta["total"],"2",".",",");
	}
	
	##METODO PARA OBTENER SUS VENTAS DE UN CLIENTE EN SU MENU
	public static function registrosVentasClienteController()
	{
		if (isset($_SESSION["id_usuario"])) {
			$respuesta = Datos::registrosDelMesActualClienteModel("venta_cliente", $_SESSION["id_usuario"]);
			return $respuesta;
		}
	}


	#OBTENER EL TOTAL DE LAS VENTAS GENERADAS DEL DIA A MESAS Y CLIENTES
	#METODO PARA OBTENER EL TOTAL DE LO QUE SE LES COBRO A LOS CLIENTES DE CUENTAS PASADAS
	#-----------------------------------------------
	public static function obtenerTotalVentasMesasDelDiaGralController(){
		$respuesta = Datos::obtenerTotalVentasMesasDelDiaGralModel();
		return $respuesta;
	}
	
	#OBTENER EL TOTAL DEL EFECTIVO DE MESAS Y CLIENTES
	#-----------------------------------------------
	public static function obtenerTotalEnEfectivoDiaGralController(){
		$respuesta = Datos::obtenerTotalEnEfectivoDiaGralModel();
		return $respuesta;
	}

	#OBTENER EL TOTAL DE LO PAGADO EN TARJETA DE MESAS Y CLIENTES
	#-----------------------------------------------
	public static function obtenerTotalEnTarjetaDiaGralController(){
		$respuesta = Datos::obtenerTotalEnTarjetaDiaGralModel();
		return $respuesta;
	}

	#OBTENER EL TOTAL DE LO PAGADO EN TARJETA DE MESAS Y CLIENTES
	#-----------------------------------------------
	public static function obtenerTotalAcuentaDiaGralController(){
		$respuesta = Datos::obtenerTotalAcuentaDiaGralModel();
		return $respuesta;
	}


	

	


		
}
