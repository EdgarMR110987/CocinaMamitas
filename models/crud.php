<?php

#EXTENSIÓN DE CLASES: Los objetos pueden ser extendidos, y pueden heredar propiedades y métodos. Para definir una clase como extensión, debo definir una clase padre, y se utiliza dentro de una clase hija.

require_once "conectarBD.php";
date_default_timezone_set('America/Mexico_City');


class Datos extends Conexion{

	#REGISTRO DE USUARIOS
	#-------------------------------------
	public static function registroUsuarioModel($datosModel, $tabla){
		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usuario, contrasena, password, 
                perfil, saldo_actual) VALUES (:usuario, :contrasena,
                :password, :perfil, :saldo_actual)");	
		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$password =  password_hash($datosModel["contrasena"], PASSWORD_DEFAULT);
		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":contrasena", $datosModel["contrasena"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $password, PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $datosModel["perfil"], PDO::PARAM_STR);
		$stmt->bindParam(":saldo_actual", $datosModel["saldo_actual"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "success";
		}else{
            return $stmt->errorInfo();
		}
		$stmt->close();

	}

	#INGRESO USUARIO
	#-------------------------------------
	public static function ingresoUsuarioModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE usuario = :usuario");	
		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

    #VISTA GENERAL DE LAS TABLAS
	#-------------------------------------
	public static function vistaGeneralTablaModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");	
		$stmt->execute();
		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();
		$stmt->close();
	}

    #EDITAR CUALQUIER DATO
	#-------------------------------------
	public static function editarGeneralModel($datosModel, $tabla, $columna){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $columna = :$columna");
		$stmt->bindParam(":$columna", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	#EDITAR USUARIO
	#-------------------------------------
	public static function editarUsuarioModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_usuario = :id_usuario");
		$stmt->bindParam(":id_usuario", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}
    

	#ACTUALIZAR USUARIO
	#-------------------------------------
	public static function actualizarUsuarioModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario=:usuario, perfil=:perfil,
				contrasena=:contrasena, password=:password, saldo_actual=:saldo_actual
				WHERE id_usuario=:id_usuario");
        $contrasena =  password_hash($datosModel["contrasena"], PASSWORD_DEFAULT); //GENERAMOS HASH
		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $datosModel["perfil"], PDO::PARAM_STR);
        $stmt->bindParam(":contrasena", $datosModel["contrasena"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $contrasena, PDO::PARAM_STR);
        $stmt->bindParam(":saldo_actual", $datosModel["saldo_actual"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario", $datosModel["id_usuario"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		} else {
            $error = $stmt->errorInfo();
            return $error;
		}
		$stmt->close();
	}

	#BORRAR REGISTRO GENERAL
	#------------------------------------
	public static function borrarFilaModel($datosModel, $tabla, $nombre_campo){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $nombre_campo = :$nombre_campo");
		$stmt->bindParam(":$nombre_campo", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
            $arr = $stmt->errorInfo();
            return $arr;
		}
		$stmt->close();
	}

    #REGISTRO DE MESA NUEVA
	#-------------------------------------
	public static function registroMesaModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare(" INSERT INTO $tabla(num_mesa, ubicacion, estado)
                VALUES (:num_mesa, :ubicacion, :estado)");	
		$stmt->bindParam(":num_mesa", $datosModel["num_mesa"], PDO::PARAM_STR);
		$stmt->bindParam(":ubicacion", $datosModel["ubicacion"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datosModel["estado"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "success";
		}else{
            $error = $stmt->errorInfo();
            return $error;
		}
		$stmt->close();
	}

	#ACTUALIZAR MESA
	#-------------------------------------
	public static function actualizarMesaModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET num_mesa=:num_mesa, estado=:estado,
				ubicacion=:ubicacion WHERE id_mesa=:id_mesa");
		$stmt->bindParam(":num_mesa", $datosModel["num_mesa"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datosModel["estado"], PDO::PARAM_STR);
        $stmt->bindParam(":ubicacion", $datosModel["ubicacion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_mesa", $datosModel["id_mesa"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		} else {
            $error = $stmt->errorInfo();
            return $error;
		}
		$stmt->close();
	}

	#VISTA PRODUCTOS
	#-------------------------------------
	public static function vistaProductoTablaModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla LEFT JOIN categorias 
                ON id_categoria = id_categoria_p");	
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

    #REGISTRO PRODUCTO
	#-------------------------------------
	public static function registroProductoModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion_p, id_categoria_p, precio_compra,
				precio_venta, foto_p, activo) VALUES(:descripcion_p, :id_categoria_p, :precio_compra,
				:precio_venta, :foto_p, :activo)");	
		$stmt->bindParam(":descripcion_p", $datosModel["descripcion_p"], PDO::PARAM_STR);
		$stmt->bindParam(":id_categoria_p", $datosModel["id_categoria_p"], PDO::PARAM_INT);
        $stmt->bindParam(":precio_compra", $datosModel["precio_compra"], PDO::PARAM_STR);
        $stmt->bindParam(":precio_venta", $datosModel["precio_venta"], PDO::PARAM_STR);
		$stmt->bindParam(":foto_p", $datosModel["foto_p"], PDO::PARAM_STR);
		$stmt->bindParam(":activo", $datosModel["activo"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "success";
		}else{
            $error = $stmt->errorInfo();
            return $error;
		}
		$stmt->close();
	}

	#ACTUALIZAR PRODUCTO SIN FOTO
	#------------------------------------------------------------------------------------------
	public static function actualizarProductoSFotoModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion_p=:descripcion_p,
				id_categoria_p = :id_categoria_p, precio_compra = :precio_compra, precio_venta =:precio_venta,
				activo = :activo WHERE id_producto = :id_producto");	
		$stmt->bindParam(":descripcion_p", $datosModel["descripcion_p"], PDO::PARAM_STR);
		$stmt->bindParam(":id_categoria_p", $datosModel["id_categoria_p"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datosModel["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datosModel["precio_venta"], PDO::PARAM_STR);
		$stmt->bindParam(":activo", $datosModel["activo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_producto", $datosModel["id_producto"], PDO::PARAM_INT);  
        if($stmt->execute()){
			return "success";
		}else{
            $error = $stmt->errorInfo();
            return $error;
		}
		$stmt->close();
	}    

	#ACTUALIZAR PRODUCTO CON FOTO
	#------------------------------------------------------------------------------------------
	public static function actualizarProductoCFotoModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion_p=:descripcion_p,
				id_categoria_p = :id_categoria_p, precio_compra = :precio_compra, precio_venta =:precio_venta,
				foto_p = :foto_p, activo = :activo WHERE id_producto = :id_producto");	
		$stmt->bindParam(":descripcion_p", $datosModel["descripcion_p"], PDO::PARAM_STR);
		$stmt->bindParam(":id_categoria_p", $datosModel["id_categoria_p"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datosModel["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datosModel["precio_venta"], PDO::PARAM_STR);
		$stmt->bindParam(":foto_p", $datosModel["foto_p"], PDO::PARAM_STR);
		$stmt->bindParam(":activo", $datosModel["activo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_producto", $datosModel["id_producto"], PDO::PARAM_INT);  
        if($stmt->execute()){
			return "success";
		}else{
            $error = $stmt->errorInfo();
            return $error;
		}
		$stmt->close();
	}

    #VISTA DE CLIENTES O MESEROS Y CAJEROS PARA VENTA
	#-------------------------------------
	public static function vistaClientesModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE perfil <> 'administrador'");	
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
    
    #REGISTRO DE CATEGORIA
	#-------------------------------------
	public static function registroCategoriaModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion_cat, foto_cat)
                VALUES (:descripcion_cat, :foto_cat)");	
		$stmt->bindParam(":descripcion_cat", $datosModel["descripcion_cat"], PDO::PARAM_STR);
		$stmt->bindParam(":foto_cat", $datosModel["foto_cat"], PDO::PARAM_STR);
        if($stmt->execute()){
			return "success";
		}else{
            $error = $stmt->errorInfo();
            return $error;
		}
		$stmt->close();
	}
        
	#ACTUALIZAR CATEGORIA SIN FOTO
	#---------------------------------------------------------------------------------------------
	public static function actualizarCategoriaSFotoModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion_cat=:descripcion_cat
				WHERE id_categoria=:id_categoria");	
		$stmt->bindParam(":descripcion_cat", $datosModel["descripcion_cat"], PDO::PARAM_STR);
		$stmt->bindParam(":id_categoria", $datosModel["id_categoria"], PDO::PARAM_INT);  
        if($stmt->execute()){
			return "success";
		}else{
            $error = $stmt->errorInfo();
            return $error;
		}
		$stmt->close();
	}    

	#ACTUALIZAR CATEGORIA CON FOTO
	#---------------------------------------------------------------------------------------------
	public static function actualizarCategoriaCFotoModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion_cat=:descripcion_cat,
				foto_cat = :foto_cat WHERE id_categoria=:id_categoria");	
		$stmt->bindParam(":descripcion_cat", $datosModel["descripcion_cat"], PDO::PARAM_STR);
		$stmt->bindParam(":foto_cat", $datosModel["foto_cat"], PDO::PARAM_STR);
		$stmt->bindParam(":id_categoria", $datosModel["id_categoria"], PDO::PARAM_INT);  
        if($stmt->execute()){
			return "success";
		}else{
            $error = $stmt->errorInfo();
            return $error;
		}
		$stmt->close();
	}         

    #REGISTRAR CONFIGURACION GENERAL 
	#-------------------------------------
	public static function registrarDatosGeneralesModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_doctor, cedula_profesional,
                especialidad_consultorio, telefono_consultorio, celular_doctor, email, celular_doctor_dos,
                direccion_completa_consultorio, direccion_pagina_web, ruta_logo) VALUES (:nombre_doctor, 
                :cedula_profesional, :especialidad_consultorio, :telefono_consultorio, :celular_doctor, 
                :email, :celular_doctor_dos, :direccion_completa_consultorio, :direccion_pagina_web, 
                :ruta_logo)");
		$stmt->bindParam(":nombre_doctor", $datosModel["nombre_doctor"], PDO::PARAM_STR);
		$stmt->bindParam(":cedula_profesional", $datosModel["cedula_profesional"], PDO::PARAM_STR);
		$stmt->bindParam(":especialidad_consultorio", $datosModel["especialidad_consultorio"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono_consultorio", $datosModel["telefono_consultorio"], PDO::PARAM_STR);
		$stmt->bindParam(":celular_doctor", $datosModel["celular_doctor"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
        $stmt->bindParam(":celular_doctor_dos", $datosModel["celular_doctor_dos"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion_completa_consultorio", $datosModel["direccion_completa_consultorio"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion_pagina_web", $datosModel["direccion_pagina_web"], PDO::PARAM_STR);
        $stmt->bindParam(":ruta_logo", $datosModel["ruta_logo"], PDO::PARAM_STR);
        if($stmt->execute()){
			return "success";
		}else{
            $error = $stmt->errorInfo();
            return $error;
		}
		$stmt->close();
	}
    
    #VISTA USUARIOS
	#-------------------------------------

	public static function vistaConfiguracionModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");	
		$stmt->execute();
		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetch();
		$stmt->close();
	}
    
    #REGISTRAR CONFIGURACION GENERAL 
	#-------------------------------------
	public static function actualizarDatosGeneralesModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_doctor=:nombre_doctor, 
                cedula_profesional=:cedula_profesional, 
                especialidad_consultorio=:especialidad_consultorio, 
                telefono_consultorio=:telefono_consultorio, celular_doctor=:celular_doctor, 
                email=:email, celular_doctor_dos=:celular_doctor_dos,
                direccion_completa_consultorio=:direccion_completa_consultorio, 
                direccion_pagina_web=:direccion_pagina_web, ruta_logo=:ruta_logo 
                WHERE id_datos_generales=:id_datos_generales");
        $id_datos_generales = 1;
		$stmt->bindParam(":nombre_doctor", $datosModel["nombre_doctor"], PDO::PARAM_STR);
		$stmt->bindParam(":cedula_profesional", $datosModel["cedula_profesional"], PDO::PARAM_STR);
		$stmt->bindParam(":especialidad_consultorio", $datosModel["especialidad_consultorio"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono_consultorio", $datosModel["telefono_consultorio"], PDO::PARAM_STR);
		$stmt->bindParam(":celular_doctor", $datosModel["celular_doctor"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
        $stmt->bindParam(":celular_doctor_dos", $datosModel["celular_doctor_dos"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion_completa_consultorio", $datosModel["direccion_completa_consultorio"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion_pagina_web", $datosModel["direccion_pagina_web"], PDO::PARAM_STR);
        $stmt->bindParam(":ruta_logo", $datosModel["ruta_logo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_datos_generales", $id_datos_generales, PDO::PARAM_INT);
        if($stmt->execute()){
			return "success";
		}else{
            $error = $stmt->errorInfo();
            return $error;
		}
		$stmt->close();
	}

   	#REGISTRAR VENTA CLIENTE
	#-------------------------------------
	public static function registroVentaClienteModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_cliente_venta_c, id_usuario_venta_c,
				forma_pago_venta_c, fecha_venta_c, estado_venta_c, comentarios_venta_c) 
				VALUES (:id_cliente_venta_c, :id_usuario_venta_c, :forma_pago_venta_c, (SELECT NOW()), 
				:estado_venta_c, :comentarios_venta_c)");
		$stmt->bindParam(":id_cliente_venta_c", $datosModel["id_cliente_venta_c"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario_venta_c", $datosModel["id_usuario_venta_c"], PDO::PARAM_INT);
		$stmt->bindParam(":forma_pago_venta_c", $datosModel["forma_pago_venta_c"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_venta_c", $datosModel["estado_venta_c"], PDO::PARAM_STR);
		$stmt->bindParam(":comentarios_venta_c", $datosModel["comentarios_venta_c"], PDO::PARAM_STR);
        if($stmt->execute()){
			return "success";
		}else{
            $error = $stmt->errorInfo();
            return $error;
		}
		$stmt->close();
	}

	#DATOS DEL ULTIMO REGISTRO
	#-------------------------------------
	public static function vistaUltimaVentaClienteModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla LEFT JOIN 
				usuarios ON id_usuario = id_cliente_venta_c ORDER BY id_venta_c DESC LIMIT 1");	
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	#VISTA VENTA A CLIENTES
	#-------------------------------------
	public static function vistaVentasClientesModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT *, u1.usuario as cliente, u2.usuario as vendedor FROM $tabla 
				LEFT JOIN usuarios u1 ON u1.id_usuario = id_cliente_venta_c 
				LEFT JOIN usuarios u2 ON u2.id_usuario = id_usuario_venta_c");	
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	#VISTA DE LAS VENTAS A LAS MESAS
	#-------------------------------------
	public static function vistaVentasMesasModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT *, u1.usuario as vendedor, mesas.num_mesa as num_mesa FROM $tabla 
				LEFT JOIN usuarios u1 ON u1.id_usuario = id_usuario_venta_m
				LEFT JOIN mesas ON id_mesa = id_mesa_venta_m 
				ORDER BY fecha_venta_m DESC");	
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
	
	#VISTA DE LAS PARTIDAS DE LAS VENTAS A CLIENTES
	#--------------------------------------------------------------------------
	public static function vistaPartidasVentaClienteModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla 
				LEFT JOIN venta_cliente ON id_venta_c = id_venta_c_partida 
				LEFT JOIN productos ON id_producto = id_producto_partida
				WHERE id_venta_c_partida = :id_venta_c_partida");	
		$stmt->bindParam(":id_venta_c_partida", $datosModel, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
	
	#CANCELAR UNA PARTIDA DE UNA VENTA A UN CLIENTE
	#---------------------------------------------------------------------------------------------
	public static function cancelarPartidaVentaClienteModel($datosModel, $tabla, $estado_partida, $id_venta_c, $subtotal_venta, $total_venta_c){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado_partida = :estado_partida
				WHERE id_partida_venta_c = :id_partida_venta_c");
		$stmt->bindParam(":estado_partida", $estado_partida, PDO::PARAM_STR);
		$stmt->bindParam(":id_partida_venta_c", $datosModel, PDO::PARAM_INT);
		if($estado_partida == "cancelado")
			$nvo_total = ($total_venta_c - $subtotal_venta);
		else
			$nvo_total = ($total_venta_c + $subtotal_venta);
		if($stmt->execute()){
			$update = Conexion::conectar()->prepare("UPDATE venta_cliente 
				SET total_venta_c = :total_venta_c
				WHERE id_venta_c = :id_venta_c");
			$update->bindParam(":total_venta_c", $nvo_total, PDO::PARAM_STR);
			$update->bindParam(":id_venta_c", $id_venta_c, PDO::PARAM_INT);
			if($update->execute()){
				return "success";
			}else{
				$error = $update->errorInfo();
				return $error;
			}
			$update->close();
		}else{
            $error = $stmt->errorInfo();
            return $error;
		}
		$stmt->close();
	}

	#ACTUALIZAR EL TOTAL DE UNA VENTA A CLIENTE, CADA QUE BORRAMOS PARTIDAS O AGREGAMOS PARTIDAS
	#............................................................................................
	public static function actualizar_venta_Model($datosModel){
		$update = Conexion::conectar()->prepare("UPDATE venta_cliente SET total_venta_c = :total_venta_c
					WHERE id_venta_c = :id_venta_c");
		$nvo_total = ($datosModel["total_venta"] - $datosModel["subtotal_p"]);
		$update->bindParam(":total_venta_c", $nvo_total, PDO::PARAM_STR);
		$update->bindParam(":id_venta_c", $datosModel["id_venta"], PDO::PARAM_INT);
		if($update->execute()){
			return "success";
		}else{
			$error = $update->errorInfo();
			return $error;
		}
	}

	#OBTENER EL PRECIO DEL PRODUCTO
	#....................................................................................................
	public static function obtenerPrecioProductoModel($tabla, $datosModel){
		$stmt = Conexion::conectar()->prepare("SELECT precio_venta FROM $tabla 
				WHERE id_producto = :id_producto");	
		$stmt->bindParam(":id_producto", $datosModel["id_producto"], PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	#REGISTRAR PARTIDA NUEVA A VENTA 
	#-------------------------------------
	public static function insertarPartidaVentaModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_venta_c_partida, id_producto_partida, 
				cantidad_producto_partida, subtotal_partida, comentarios_partida, estado_partida,
				fecha_registro_partida, fecha_update_partida) VALUES (:id_venta_c_partida, 
				:id_producto_partida, :cantidad_producto_partida, :subtotal_partida, :comentarios_partida,
				:estado_partida, (SELECT NOW()), (SELECT NOW()))");	

		$stmt->bindParam(":id_venta_c_partida", $datosModel["id_venta_agregar_p"], PDO::PARAM_INT);
		$stmt->bindParam(":id_producto_partida", $datosModel["id_prod_venta"], PDO::PARAM_INT);
		$stmt->bindParam(":cantidad_producto_partida", $datosModel["cant_partida_v"], PDO::PARAM_INT);
		$stmt->bindParam(":subtotal_partida", $datosModel["sub_total_venta"], PDO::PARAM_STR);
		$stmt->bindParam(":comentarios_partida", $datosModel["comentarios_partida"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_partida", $datosModel["estado_partida"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "success";
		}else{
            return $stmt->errorInfo();
		}
		$stmt->close();

	}
	
	public static function obtenerTotalVentaClienteModel($datosModel){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM venta_cliente 
				WHERE id_venta_c = :id_venta_c");	
		$stmt->bindParam(":id_venta_c", $datosModel, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}
	
	public static function actualizarVentaClienteModel($datosModel){
		$update = Conexion::conectar()->prepare("UPDATE venta_cliente SET total_venta_c = :total_venta_c
					WHERE id_venta_c = :id_venta_c");
		$update->bindParam(":total_venta_c", $datosModel["total_venta"], PDO::PARAM_STR);
		$update->bindParam(":id_venta_c", $datosModel["id_venta"], PDO::PARAM_INT);
		if($update->execute()){
			return "success";
		}else{
			$error = $update->errorInfo();
			return $error;
		}
	}
	
	#REGISTRAR VENTA A UNA MESA
	#-------------------------------------
	public static function registroVentaMesaModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_usuario_venta_m, id_mesa_venta_m,
				fecha_venta_m) VALUES (:id_usuario_venta_m, :id_mesa_venta_m, (SELECT NOW()))");
		$stmt->bindParam(":id_usuario_venta_m", $datosModel["id_usuario_venta_m"], PDO::PARAM_INT);
		$stmt->bindParam(":id_mesa_venta_m", $datosModel["id_mesa_venta_m"], PDO::PARAM_INT);
        if($stmt->execute()){
			$id = Conexion::conectar()->prepare("SELECT MAX(id_venta_m) as id_venta_m FROM $tabla");
			$id->execute();
			return $id->fetch();
		}else{
            $error = $stmt->errorInfo();
            return $error;
		}
		$id->close();
		$stmt->close();
	}


	public static function vistaVentaMesaModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla 
				LEFT JOIN mesas ON id_mesa = id_mesa_venta_m 
				WHERE id_venta_m = :id_venta_m");	
		$stmt->bindParam(":id_venta_m", $datosModel, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}
	
		
	public static function nombreUsuarioModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_usuario = :id_usuario");	
		$stmt->bindParam(":id_usuario", $datosModel, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}
	

	#INSERTAR PARTIDA NUEVA A VENTA DE MESA
	#-------------------------------------
	public static function insertarPartidaVentaMesaModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_venta_m_partida, id_producto_partida_m, 
				cantidad_producto_partida_m, subtotal_partida_m, comentarios_partida_m, fecha_registro_partida_m, 
				fecha_update_partida_m) VALUES (:id_venta_m_partida, :id_producto_partida_m, 
				:cantidad_producto_partida_m, :subtotal_partida_m, :comentarios_partida_m, (SELECT NOW()), 
				(SELECT NOW()))");	
		$stmt->bindParam(":id_venta_m_partida", $datosModel["id_venta_m"], PDO::PARAM_INT);
		$stmt->bindParam(":id_producto_partida_m", $datosModel["id_prod_part_v_mesa"], PDO::PARAM_INT);
		$stmt->bindParam(":cantidad_producto_partida_m", $datosModel["cant_prod_part_v_mesa"], PDO::PARAM_INT);
		$stmt->bindParam(":subtotal_partida_m", $datosModel["sub_total_venta"], PDO::PARAM_STR);
		$stmt->bindParam(":comentarios_partida_m", $datosModel["comentarios_part_v_mesa"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "success";
		}else{
            return $stmt->errorInfo();
		}
		$stmt->close();
	}
	
	#OBTENER EL TOTAL DE LA VENTA DE UNA MESA
	#-----------------------------------------------------	
	public static function obtenerTotalVentaMesaModel($datosModel){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM venta_mesa 
				WHERE id_venta_m = :id_venta_m");	
		$stmt->bindParam(":id_venta_m", $datosModel, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}
	
	#ACTUALIZAR EL TOTAL DE UNA MESA AL AGREGAR UN NUEVO PRODUCTO
	#-------------------------------------------
	public static function actualizarVentaMesaModel($datosModel){
		$update = Conexion::conectar()->prepare("UPDATE venta_mesa SET total_venta_m = :total_venta_m
					WHERE id_venta_m = :id_venta_m");
		$update->bindParam(":total_venta_m", $datosModel["total_venta_m"], PDO::PARAM_STR);
		$update->bindParam(":id_venta_m", $datosModel["id_venta_m"], PDO::PARAM_INT);
		if($update->execute()){
			return "success";
		}else{
			$error = $update->errorInfo();
			return $error;
		}
	}

	
	public static function vistaPartidasVentaMesaModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla 
				LEFT JOIN venta_mesa ON id_venta_m = id_venta_m_partida 
				LEFT JOIN productos ON id_producto = id_producto_partida_m
				WHERE id_venta_m_partida = :id_venta_m_partida");	
		$stmt->bindParam(":id_venta_m_partida", $datosModel, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	#ACTUALIZAR ESTADO DE UNA VENTA A MESA
	#-------------------------------------------
	public static function cambiarEstadoVentaMesaModel($datosModel, $tabla){
		$update = Conexion::conectar()->prepare("UPDATE $tabla SET estado_venta_m = :estado_venta_m,
					forma_pago_m = :forma_pago_m, imp_efectivo = :imp_efectivo, imp_tarjeta = :imp_tarjeta
					WHERE id_venta_m = :id_venta_m");
		$update->bindParam(":estado_venta_m", $datosModel["estado_venta_m"], PDO::PARAM_STR);
		$update->bindParam(":forma_pago_m", $datosModel["forma_pago_m"], PDO::PARAM_STR);
		$update->bindParam(":imp_efectivo", $datosModel["imp_efectivo"], PDO::PARAM_STR);
		$update->bindParam(":imp_tarjeta", $datosModel["imp_tarjeta"], PDO::PARAM_STR);
		$update->bindParam(":id_venta_m", $datosModel["id_venta_m"], PDO::PARAM_INT);
		if($update->execute()){
			return "success";
		}else{
			$error = $update->errorInfo();
			return $error;
		}
	}

	#ACTUALIZAR ESTADO DE MESA
	#-------------------------------------------
	public static function cambiarEstadoMesaModel($datosModel, $tabla){
		$update = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado
					WHERE id_mesa = :id_mesa");
		$update->bindParam(":estado", $datosModel["estado"], PDO::PARAM_STR);
		$update->bindParam(":id_mesa", $datosModel["id_mesa"], PDO::PARAM_INT);
		if($update->execute()){
			return "success";
		}else{
			$error = $update->errorInfo();
			return $error;
		}
	}

	public static function vistaVentaMesaDatoModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla 
				LEFT JOIN mesas ON id_mesa = id_mesa_venta_m 
				WHERE id_mesa_venta_m = :id_mesa_venta_m AND estado_venta_m = 'abierta'");	
		$stmt->bindParam(":id_mesa_venta_m", $datosModel, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	public static function ultimaMesaRegistradaModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_mesa DESC LIMIT 1 ");	
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	public static function totalVentasMesaModel($tabla, $datosModel){
		$stmt = Conexion::conectar()->prepare("SELECT SUM(total_venta_m) AS total_ventas_mesas 
				FROM $tabla WHERE estado_venta_m = :estado_venta_m");
		$stmt->bindParam(":estado_venta_m", $datosModel, PDO::PARAM_STR);	
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	public static function busquedaVentaMesasModel($columna, $tabla, $datosModel){
		$stmt = Conexion::conectar()->prepare("SELECT *, u1.usuario as vendedor, mesas.num_mesa as num_mesa 
				FROM $tabla 
				LEFT JOIN usuarios u1 ON u1.id_usuario = id_usuario_venta_m
				LEFT JOIN mesas ON id_mesa = id_mesa_venta_m WHERE $columna = :$columna");
		$stmt->bindParam(":$columna", $datosModel, PDO::PARAM_STR);	
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	#METODO PARA BUSCAR CON PARAMETRO INT
	public static function busquedaVentaMesasIntModel($columna, $tabla, $datosModel){
		$stmt = Conexion::conectar()->prepare("SELECT *, u1.usuario as vendedor, mesas.num_mesa as num_mesa 
				FROM $tabla 
				LEFT JOIN usuarios u1 ON u1.id_usuario = id_usuario_venta_m
				LEFT JOIN mesas ON id_mesa = id_mesa_venta_m WHERE $columna = :$columna");
		$stmt->bindParam(":$columna", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	#METODO PARA BUSCAR ENTRE UN RANGO DE FECHAS
	public static function busquedaFechaVentaMesasModel($tabla, $fecha_inicio, $fecha_termino){
		$stmt = Conexion::conectar()->prepare("SELECT *, u1.usuario as vendedor, mesas.num_mesa as num_mesa 
				FROM $tabla 
				LEFT JOIN usuarios u1 ON u1.id_usuario = id_usuario_venta_m
				LEFT JOIN mesas ON id_mesa = id_mesa_venta_m 
				WHERE fecha_venta_m BETWEEN :fecha_inicio AND :fecha_termino");
		$stmt->bindParam(":fecha_inicio", $fecha_inicio, PDO::PARAM_STR);
		$stmt->bindParam(":fecha_termino", $fecha_termino, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
	
	#METODO PARA OBTENER LOS REGISTRO DEL MES DE UN CLIENTE EN ESPECIFICO
	public static function registrosDelMesActualClienteModel($tabla, $id_cliente_venta_c){
		$stmt = Conexion::conectar()->prepare("SELECT *, u1.usuario as vendedor FROM $tabla
				LEFT JOIN usuarios u1 ON u1.id_usuario = id_usuario_venta_c
				WHERE MONTH(fecha_venta_c) = MONTH(CURRENT_DATE())
				AND YEAR(fecha_venta_c) = YEAR(CURRENT_DATE())
				AND id_cliente_venta_c = :id_cliente_venta_c");
		$stmt->bindParam(":id_cliente_venta_c", $id_cliente_venta_c, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}
	
	public static function obtenerParametrosModel(){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM parametros WHERE id_parametros = 1");
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	public static function altaParametrosModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (razon_social, direccion, direccion_2, 
				mensaje_inferior, ruta_logo, fecha_cambio) VALUES (:razon_social, :direccion, :direccion_2, 
				:mensaje_inferior, :ruta_logo, (SELECT NOW()) )");
		$stmt->bindParam(":razon_social", $datosModel["razon_social"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datosModel["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion_2", $datosModel["direccion_2"], PDO::PARAM_STR);
		$stmt->bindParam(":mensaje_inferior", $datosModel["mensaje_inferior"], PDO::PARAM_STR);
		$stmt->bindParam(":ruta_logo", $datosModel["ruta_logo"], PDO::PARAM_STR);
		if ($stmt->execute()) {
			return "success";
		} else {
			return $stmt->errorInfo();
		}
		$stmt->close();
	}

	public static function actualizarParametrosSFotoModel($datosModel, $tabla){
		$update = Conexion::conectar()->prepare("UPDATE $tabla SET razon_social=:razon_social, 
				direccion=:direccion, direccion_2=:direccion_2, mensaje_inferior=:mensaje_inferior, 
				fecha_cambio=(SELECT NOW()) WHERE id_parametros=1");
		$update->bindParam(":razon_social", $datosModel["razon_social"], PDO::PARAM_STR);
		$update->bindParam(":direccion", $datosModel["direccion"], PDO::PARAM_STR);
		$update->bindParam(":direccion_2", $datosModel["direccion_2"], PDO::PARAM_STR);
		$update->bindParam(":mensaje_inferior", $datosModel["mensaje_inferior"], PDO::PARAM_STR);
		if ($update->execute()) {
			return "success";
		} else {
			$error = $update->errorInfo();
			return $error;
		}
		$update->close();
	}

	public static function actualizarParametrosCFotoModel($datosModel, $tabla){
		$update = Conexion::conectar()->prepare("UPDATE $tabla SET razon_social=:razon_social, 
				direccion=:direccion, direccion_2=:direccion_2, mensaje_inferior=:mensaje_inferior, 
				ruta_logo=:ruta_logo, fecha_cambio=(SELECT NOW()) WHERE id_parametros=1");
		$update->bindParam(":razon_social", $datosModel["razon_social"], PDO::PARAM_STR);
		$update->bindParam(":direccion", $datosModel["direccion"], PDO::PARAM_STR);
		$update->bindParam(":direccion_2", $datosModel["direccion_2"], PDO::PARAM_STR);
		$update->bindParam(":mensaje_inferior", $datosModel["mensaje_inferior"], PDO::PARAM_STR);
		$update->bindParam(":ruta_logo", $datosModel["ruta_logo"], PDO::PARAM_STR);
		if ($update->execute()) {
			return "success";
		} else {
			$error = $update->errorInfo();
			return $error;
		}
		$update->close();
	}

	//PARTIDAS DE VENTA A MESA AGRUPADAS PARA EL TICKET
	public static function vistaPartidasVentaMesaTicketModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT SUM(cantidad_producto_partida_m) as cantidad, 
				descripcion_p, precio_venta, sum(subtotal_partida_m) AS subtotal FROM $tabla 
				LEFT JOIN venta_mesa ON id_venta_m = id_venta_m_partida 
				LEFT JOIN productos ON id_producto = id_producto_partida_m
				WHERE id_venta_m_partida = :id_venta_m_partida GROUP BY descripcion_p");	
		$stmt->bindParam(":id_venta_m_partida", $datosModel, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	//OBTENER VALORES DE LA VENTA A MESA PARA TICKET
	public static function vistaVentaMesaTicketModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla 
				LEFT JOIN mesas ON id_mesa = id_mesa_venta_m 
				LEFT JOIN usuarios ON id_usuario = id_usuario_venta_m 
				WHERE id_venta_m = :id_venta_m");	
		$stmt->bindParam(":id_venta_m", $datosModel, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

//PARTIDAS DE VENTA A MESA AGRUPADAS PARA EL TICKET
	public static function vistaPartidasVentaClienteTicketModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT SUM(cantidad_producto_partida) as cantidad, 
				descripcion_p, precio_venta, sum(subtotal_partida) AS subtotal FROM $tabla 
				LEFT JOIN venta_cliente ON id_venta_c = id_venta_c_partida 
				LEFT JOIN productos ON id_producto = id_producto_partida
				WHERE id_venta_c_partida = :id_venta_c_partida GROUP BY descripcion_p");	
		$stmt->bindParam(":id_venta_c_partida", $datosModel, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	//PARTIDAS DE VENTA A MESA AGRUPADAS PARA EL TICKET
	public static function obtenerNombreClienteIdModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT usuario FROM $tabla 
				WHERE id_usuario = :id_usuario");	
		$stmt->bindParam(":id_usuario", $datosModel, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	//OBTENER VALORES DE LA VENTA A MESA PARA TICKET
	public static function vistaVentaClienteTicketModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT *, u1.usuario AS cliente, u2.usuario AS mesero 
				FROM $tabla
				LEFT JOIN usuarios u1 ON u1.id_usuario = id_cliente_venta_c
				LEFT JOIN usuarios u2 ON u2.id_usuario = id_usuario_venta_c
				WHERE id_venta_c = :id_venta_c");	
		$stmt->bindParam(":id_venta_c", $datosModel, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}


	
	//PARTIDAS DE TODAS LAS VENTAS A MESAS AGRUPADAS PARA EL CORTE DE CAJA
	public static function obtenerPartidasVentasMesasGralModel($tabla){
		$hora_actual = date("H");
		if(intval($hora_actual) >= 0 && intval($hora_actual) <= 17){
			$fecha_inicio = new DATETIME(date("Y-m-d 18:00:00")); // SE CREA UNA FECHA PARA PODERLE AGREGAR UN DIA
			$fecha_inicio_in = date_add($fecha_inicio, date_interval_create_from_date_string("-1 day")); // SE AGREGA UN DIA A LA FECHA DE INICIO			
			$fecha_inicio_i = $fecha_inicio_in->format("Y-m-d 18:00:00");
			$fecha_termino = date_add($fecha_inicio_in, date_interval_create_from_date_string("1 day")); // SE AGREGA UN DIA A LA FECHA DE INICIO
			$fecha_termino_b = $fecha_termino->format("Y-m-d 17:00:00"); //SE DA SALIDA DE LA FECHA DE LIMITE AGREGANDO LA HORA DE TERMINO DEL TURNO
		}else{
			$fecha_inicio_i = date("Y-m-d 18:00:00"); //SE DEFINE LA HORA DE APERTURA
			$fecha_inicio = new DATETIME(date("Y-m-d")); // SE CREA UNA FECHA PARA PODERLE AGREGAR UN DIA
			$fecha_termino = date_add($fecha_inicio, date_interval_create_from_date_string("1 day")); // SE AGREGA UN DIA A LA FECHA DE INICIO
			$fecha_termino_b = $fecha_termino->format("Y-m-d 17:00:00"); //SE DA SALIDA DE LA FECHA DE LIMITE AGREGANDO LA HORA DE TERMINO DEL TURNO
		}
		
	$stmt = Conexion::conectar()->prepare("SELECT SUM(cantidad_producto_partida_m) as cantidad, 
				descripcion_p, precio_venta, sum(subtotal_partida_m) AS subtotal FROM $tabla 
				LEFT JOIN productos ON id_producto = id_producto_partida_m
				WHERE fecha_registro_partida_m >= :fecha_inicio_i AND
					  fecha_registro_partida_m <= :fecha_termino_b 
				GROUP BY descripcion_p");
		$stmt->bindParam(":fecha_inicio_i", $fecha_inicio_i, PDO::PARAM_STR);
		$stmt->bindParam(":fecha_termino_b", $fecha_termino_b, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	//PARTIDAS DE TODAS LAS VENTAS A MESAS AGRUPADAS PARA EL CORTE DE CAJA
	public static function obtenerTotalPartidasVentasMesasGralModel($tabla){
		$fecha_inicio_i = date("Y-m-d 18:00:00"); //SE DEFINE LA HORA DE APERTURA
		$fecha_inicio = new DATETIME(date("Y-m-d")); // SE CREA UNA FECHA PARA PODERLE AGREGAR UN DIA
		$fecha_termino = date_add($fecha_inicio, date_interval_create_from_date_string("1 day")); // SE AGREGA UN DIA A LA FECHA DE INICIO
		$fecha_termino_b = $fecha_termino->format("Y-m-d 17:00:00"); //SE DA SALIDA DE LA FECHA DE LIMITE AGREGANDO LA HORA DE TERMINO DEL TURNO
		$stmt = Conexion::conectar()->prepare("SELECT sum(subtotal_partida_m) AS total FROM $tabla 
				LEFT JOIN productos ON id_producto = id_producto_partida_m
				WHERE
					fecha_registro_partida_m >= :fecha_inicio_i
				AND
					fecha_registro_partida_m <= :fecha_termino_b");
		$stmt->bindParam(":fecha_inicio_i", $fecha_inicio_i, PDO::PARAM_STR);
		$stmt->bindParam(":fecha_termino_b", $fecha_termino_b, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	
	public static function actualizarSaldoClienteModel($datosModel){
		$update = Conexion::conectar()->prepare("UPDATE usuarios SET saldo_actual = :saldo_actual
					WHERE id_usuario = :id_usuario");
		$update->bindParam(":saldo_actual", $datosModel["saldo_actual"], PDO::PARAM_STR);
		$update->bindParam(":id_usuario", $datosModel["id_usuario"], PDO::PARAM_INT);
		if($update->execute()){
			return "success";
		}else{
			$error = $update->errorInfo();
			return $error;
		}
	}

	//METODO PARA COBRAR UN CUENTA
	public static function actualizarEstadoVentaClientePagadaModel($tabla, $datosModel){
		$update = Conexion::conectar()->prepare("UPDATE $tabla SET estado_venta_c = 'pagada'
					WHERE id_venta_c = :id_venta_c");
		$update->bindParam(":id_venta_c", $datosModel["id_venta_c"], PDO::PARAM_INT);
		if($update->execute()){
			$actualizarPartidas = Conexion::conectar()->prepare("UPDATE partida_venta_c SET estado_partida = 'cobrado', 
				fecha_update_partida = (SELECT NOW())
				WHERE id_venta_c_partida = :id_venta_c_partida");
			$actualizarPartidas->bindParam(":id_venta_c_partida", $datosModel["id_venta_c"], PDO::PARAM_INT);
			$actualizarPartidas->execute();
			return "success";			
		}else{
			$error = $update->errorInfo();
			return $error;
		}
	}
	

	//PARTIDAS DE TODAS LAS VENTAS A CLIENTES AGRUPADAS PARA EL CORTE DE CAJA
	public static function obtenerPartidasVentasClientesGralModel($tabla){
		$fecha_inicio_i = date("Y-m-d 18:00:00"); //SE DEFINE LA HORA DE APERTURA
		$fecha_inicio = new DATETIME(date("Y-m-d")); // SE CREA UNA FECHA PARA PODERLE AGREGAR UN DIA
		$fecha_termino = date_add($fecha_inicio, date_interval_create_from_date_string("1 day")); // SE AGREGA UN DIA A LA FECHA DE INICIO
		$fecha_termino_b = $fecha_termino->format("Y-m-d 17:00:00"); //SE DA SALIDA DE LA FECHA DE LIMITE AGREGANDO LA HORA DE TERMINO DEL TURNO
		$stmt = Conexion::conectar()->prepare("SELECT SUM(cantidad_producto_partida) as cantidad, 
				descripcion_p, precio_venta, sum(subtotal_partida) AS subtotal FROM $tabla 
				LEFT JOIN productos ON id_producto = id_producto_partida
				WHERE fecha_registro_partida >= :fecha_inicio_i AND
					  fecha_registro_partida <= :fecha_termino_b 
				GROUP BY descripcion_p");
		$stmt->bindParam(":fecha_inicio_i", $fecha_inicio_i, PDO::PARAM_STR);
		$stmt->bindParam(":fecha_termino_b", $fecha_termino_b, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	//PARTIDAS DE TODAS LAS VENTAS A CLIENTES AGRUPADAS PARA EL CORTE DE CAJA
	public static function obtenerTotalPartidasVentasClientesGralModel($tabla){
		$fecha_inicio_i = date("Y-m-d 18:00:00"); //SE DEFINE LA HORA DE APERTURA
		$fecha_inicio = new DATETIME(date("Y-m-d")); // SE CREA UNA FECHA PARA PODERLE AGREGAR UN DIA
		$fecha_termino = date_add($fecha_inicio, date_interval_create_from_date_string("1 day")); // SE AGREGA UN DIA A LA FECHA DE INICIO
		$fecha_termino_b = $fecha_termino->format("Y-m-d 17:00:00"); //SE DA SALIDA DE LA FECHA DE LIMITE AGREGANDO LA HORA DE TERMINO DEL TURNO
		$stmt = Conexion::conectar()->prepare("SELECT sum(subtotal_partida) AS total FROM $tabla 
				LEFT JOIN productos ON id_producto = id_producto_partida
				WHERE

					fecha_registro_partida >= :fecha_inicio_i
				AND
					fecha_registro_partida <= :fecha_termino_b");
		$stmt->bindParam(":fecha_inicio_i", $fecha_inicio_i, PDO::PARAM_STR);
		$stmt->bindParam(":fecha_termino_b", $fecha_termino_b, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}


	//OBTENER EL TOTAL DE LAS CUENTAS COBRADAS A CLIENTES DE SALDOS ANTERIORES PARA EL CORTE DE CAJA
	public static function obtenerTotalSaldosCobradosVentasClientesGralModel($tabla){
		$fecha_inicio_i = date("Y-m-d 18:00:00"); //SE DEFINE LA HORA DE APERTURA
		$fecha_inicio = new DATETIME(date("Y-m-d")); // SE CREA UNA FECHA PARA PODERLE AGREGAR UN DIA
		$fecha_termino = date_add($fecha_inicio, date_interval_create_from_date_string("1 day")); // SE AGREGA UN DIA A LA FECHA DE INICIO
		$fecha_termino_b = $fecha_termino->format("Y-m-d 17:00:00"); //SE DA SALIDA DE LA FECHA DE LIMITE AGREGANDO LA HORA DE TERMINO DEL TURNO
		$stmt = Conexion::conectar()->prepare("SELECT sum(subtotal_partida) AS total FROM $tabla 
				LEFT JOIN productos ON id_producto = id_producto_partida
				WHERE
					estado_partida = 'cobrado'
				AND
					fecha_update_partida >= :fecha_inicio_i
				AND
					fecha_update_partida <= :fecha_termino_b");
		$stmt->bindParam(":fecha_inicio_i", $fecha_inicio_i, PDO::PARAM_STR);
		$stmt->bindParam(":fecha_termino_b", $fecha_termino_b, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	//TOTAL DE LAS VENTAS QUE SE PAGARON AL MOMENTO DE CLIENTES
	public static function obtenerTotalCobradoVentasClientesDiaGralModel($tabla){
		$fecha_inicio_i = date("Y-m-d 18:00:00"); //SE DEFINE LA HORA DE APERTURA
		$fecha_inicio = new DATETIME(date("Y-m-d")); // SE CREA UNA FECHA PARA PODERLE AGREGAR UN DIA
		$fecha_termino = date_add($fecha_inicio, date_interval_create_from_date_string("1 day")); // SE AGREGA UN DIA A LA FECHA DE INICIO
		$fecha_termino_b = $fecha_termino->format("Y-m-d 17:00:00"); //SE DA SALIDA DE LA FECHA DE LIMITE AGREGANDO LA HORA DE TERMINO DEL TURNO
		$stmt = Conexion::conectar()->prepare("SELECT sum(subtotal_partida) AS total FROM $tabla 
				LEFT JOIN productos ON id_producto = id_producto_partida
				WHERE
					estado_partida = 'pagada'
				AND
					fecha_registro_partida >= :fecha_inicio_i
				AND
					fecha_registro_partida <= :fecha_termino_b");
		$stmt->bindParam(":fecha_inicio_i", $fecha_inicio_i, PDO::PARAM_STR);
		$stmt->bindParam(":fecha_termino_b", $fecha_termino_b, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	//TOTAL DE LAS VENTAS A CUENTA DE CLIENTES
	public static function obtenerTotalACuentaVentasClientesGralModel($tabla){
		$fecha_inicio_i = date("Y-m-d 18:00:00"); //SE DEFINE LA HORA DE APERTURA
		$fecha_inicio = new DATETIME(date("Y-m-d")); // SE CREA UNA FECHA PARA PODERLE AGREGAR UN DIA
		$fecha_termino = date_add($fecha_inicio, date_interval_create_from_date_string("1 day")); // SE AGREGA UN DIA A LA FECHA DE INICIO
		$fecha_termino_b = $fecha_termino->format("Y-m-d 17:00:00"); //SE DA SALIDA DE LA FECHA DE LIMITE AGREGANDO LA HORA DE TERMINO DEL TURNO
		$stmt = Conexion::conectar()->prepare("SELECT sum(subtotal_partida) AS total FROM $tabla 
			LEFT JOIN productos ON id_producto = id_producto_partida
			WHERE
				estado_partida = 'pendiente'
			AND
				fecha_registro_partida >= :fecha_inicio_i
			AND
				fecha_registro_partida <= :fecha_termino_b");
		$stmt->bindParam(":fecha_inicio_i", $fecha_inicio_i, PDO::PARAM_STR);
		$stmt->bindParam(":fecha_termino_b", $fecha_termino_b, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	



	
	
	
}