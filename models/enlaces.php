<?php 

class Paginas{    
	public static function enlacesPaginasModel($enlaces){
        if(isset($_SESSION["autentificado"]) == "SI"){
		    if($enlaces == "Usuarios/altaUsuario" || $enlaces == "Usuarios/listadoUsuarios" 
            || $enlaces == "Usuarios/editarUsuario" || $enlaces == "Mesas/altaMesa"
            || $enlaces == "Mesas/listadoMesas" || $enlaces == "Mesas/editarMesa"
            || $enlaces == "Productos/listadoProductos" || $enlaces == "Productos/altaProducto"
            || $enlaces == "Productos/editarProducto" || $enlaces == "Productos/altaCategoria"
            || $enlaces == "Productos/listadoCategorias" || $enlaces == "Productos/editarCategoria"
            || $enlaces == "Ventas/ventaMesa" || $enlaces == "Ventas/ventaCliente"
            || $enlaces == "Ventas/editarVenta" || $enlaces == "Ventas/agregarProductoVentaCliente" 
            || $enlaces == "menuPrincipal" || $enlaces == "menuVentasClientes" 
            || $enlaces == "configuracion" || $enlaces == "Ventas/listadoVentasClientes"
            || $enlaces == "Ventas/editarVentaCliente" || $enlaces == "Ventas/agregarProductoMesa"
            || $enlaces == "Reportes/principalReportes" || $enlaces == "Reportes/listadoVentasMesas"
            || $enlaces == "Reportes/listadoVentasClientes" || $enlaces == "Reportes/detalleVentasCliente"
            || $enlaces == "Configuracion/parametros" || $enlaces == "ticket" || $enlaces == "ticketCliente"
            || $enlaces == "corteDelDia" || $enlaces == "corteCajaClientes" || $enlaces == "menuVentasMesas"
            || $enlaces == "Ventas/listadoVentasMesas" || $enlaces == "corteCajaGeneral"){
			    $module =  "views/modules/".$enlaces.".php";
            }else if($enlaces == "index"){
	    		$module =  "views/modules/Usuarios/acceso.php";
            }else if($enlaces == "salir"){
                $module =  "views/modules/logout.php";
            }  else{
                $module =  "index.php";    
            }
		    return $module;
	    }else{
            $module =  "views/modules/acceso.php";
            return $module;
        }
    }

    public static function enlacesPaginasClienteModel($enlaces){
        if(isset($_SESSION["autentificado"]) == "SI"){
		    if($enlaces == "Clientes/listadoVentasCliente" || $enlaces == "Clientes/detalleVentaCliente"){
			    $module =  "views/modules/".$enlaces.".php";
            }else if($enlaces == "index"){
	    		$module =  "views/modules/Clientes/listadoVentasCliente";
            }else if($enlaces == "salir"){
                $module =  "views/modules/logout.php";
            }  else{
                $module =  "index.php";    
            }
		    return $module;
	    }else{
            $module =  "views/modules/acceso.php";
            return $module;
        }
    }

}


?>