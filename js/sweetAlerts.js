function registroOK(url) {
    swal({
        title: "Registro Exitoso",
        text: "Redireccionando en 2 segundos .....",
        type: "success",
        timer: 5000
    }).then(() => {
        window.location.href = url;
    });
}

function pagoOK(url) {
    swal({
        title: "Pago Exitoso",
        text: "Se pago la cuenta " + url,
        type: "success",
        timer: 5000
    });
}



function actualizarOK(url) {
    swal({
        title: "Actualizacion Correcta",
        text: "Redireccionando en 2 segundos .....",
        type: "success",
        timer: 2000
    }).then(() => {
        window.location.href = url;
    });
}

function errorRegistro(error, link) {
    swal({
        title: "Error en el registro",
        text: error,
        type: "warning"
    }).then(() => {
        window.location.href = link;
    });
}


function borrarOk(link) {
    swal({
        title: "Se elimino el registro Exitosamente!",
        text: "Redireccionando en 2 segundos...",
        type: "success",
        timer: 2000
    }).then(() => {
        window.location.href = link;
    });
}

function bienvenida(usuario) {
    swal({
        title: "Acceso Exitoso!",
        text: "Bienvenido : " + usuario,
        type: "success",
        closeOnClickOutside: false,
        closeOnEsc: false,
        allowOutsideClick: false
    }).then(function (result) {
        if (result.value) {
            window.location.href = "index.php?action=menuPrincipal";
        } else { }
    });
}

function bienvenidaCliente(usuario) {
    swal({
        title: "Acceso Exitoso!",
        text: "Bienvenido : " + usuario,
        type: "success",
        closeOnClickOutside: false,
        closeOnEsc: false,
        allowOutsideClick: false
    }).then(function (result) {
        if (result.value) {
            window.location.href = "index.php?action=Clientes/listadoVentasCliente";
        } else { }
    });
}


function errorAcceso(error) {
    swal({
        title: "Acceso Denegado!",
        text: "Contraseña Incorrecta",
        type: "warning",
        closeOnClickOutside: false,
        closeOnEsc: false,
        allowOutsideClick: false
    }).then(function (result) {
        if (result.value) {
            window.location.href = "/COCINA%20MAMITAS/index.php";
        } else { }
    });

}

$(document).ready(function () {
    $('#cerrar-modal').click(function (event) {
        window.location.href = document.getElementById("link").value;
    });

    const $selectorArchivo = document.getElementById("foto_cat"),
        $imagenPrevisualizacion = document.getElementById("img_previa");
    //Escuchar cuando cambie
    if($selectorArchivo){
        $selectorArchivo.addEventListener("change", () => {
            const archivos = $selectorArchivo.files;
            if (!archivos || !archivos.length) {
                $imagenPrevisualizacion.src = "";
                return;
            }
            const primerArchivo = archivos[0];
            const objectURL = URL.createObjectURL(primerArchivo);
            $imagenPrevisualizacion.src = objectURL;
        });
    }

})

$(document).ready(function () {

    if ($("#forma_pago_mesa").val() == 'Efectivo') {
        $(".efectivo").css('display', 'none');
        $(".tarjeta_p").css('display', 'none');
        $("#imp_efectivo").val($("#total_venta_m").val());
        $("#imp_tarjeta").val("");
    } else if ($("#forma_pago_mesa").val() == 'Tarjeta') {
        $(".tarjeta_p").css('display', 'none');
        $(".efectivo").css('display', 'none');
        $("#imp_efectivo").val("");
        $("#imp_tarjeta").val($("#total_venta_m").val());
    } else if ($("#forma_pago_mesa").val() == 'Mixta') {
        $(".tarjeta_p").css('display', 'block');
        $(".efectivo").css('display', 'block');
        $("#imp_efectivo").val("");
        $("#imp_tarjeta").val("");
    }

    $("#forma_pago_mesa").change(function () {
        if ($("#forma_pago_mesa").val() == 'Efectivo') {
            $(".efectivo").css('display', 'none');
            $(".tarjeta_p").css('display', 'none');
            $("#imp_efectivo").val($("#total_venta_m").val());
            $("#imp_tarjeta").val("");
        } else if ($("#forma_pago_mesa").val() == 'Tarjeta') {
            $(".tarjeta_p").css('display', 'none');
            $(".efectivo").css('display', 'none');
            $("#imp_efectivo").val("");
            $("#imp_tarjeta").val($("#total_venta_m").val());
        } else if ($("#forma_pago_mesa").val() == 'Mixta') {
            $(".tarjeta_p").css('display', 'block');
            $(".efectivo").css('display', 'block');
            $("#imp_efectivo").val("");
            $("#imp_tarjeta").val("");
        }
    });

    $("#buscar_por").change(function () {
        switch ($("#buscar_por").val()) {
            case 'estado_venta_m':
                $("#estado_venta_m").css('display', 'flex');
                $("#forma_pago_m").css('display', 'none');
                $("#num_mesa").css('display', 'none');
                $("#fecha_venta_m").css('display', 'none');
                break;
            case 'forma_pago_m':
                $("#estado_venta_m").css('display', 'none');
                $("#forma_pago_m").css('display', 'flex');
                $("#num_mesa").css('display', 'none');
                $("#fecha_venta_m").css('display', 'none');
                break;
            case 'num_mesa':
                $("#estado_venta_m").css('display', 'none');
                $("#forma_pago_m").css('display', 'none');
                $("#num_mesa").css('display', 'flex');
                $("#fecha_venta_m").css('display', 'none');
                break;
            case 'fecha_venta_m':
                $("#estado_venta_m").css('display', 'none');
                $("#forma_pago_m").css('display', 'none');
                $("#num_mesa").css('display', 'none');
                $("#fecha_venta_m").css('display', 'flex');
                break;
        }
    });

    $("#btn_buscar").click(function () {
        switch ($("#buscar_por").val()) {
            case "estado_venta_m":
                $.ajax({
                    type: 'post',
                    url: 'views/modules/Reportes/busquedaVentaMesas.php',
                    data: { "columna": "estado_venta_m", "valor": $("#v_estado_venta_m").val(), "tipo": "" },
                    dataType: "html",
                    success: function (resp) {
                        $('#tabla_ventas_mesas').html(resp);
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert("Status: " + textStatus); alert("Error: " + errorThrown);
                    }
                });
                return false;
                break;
            case "forma_pago_m":
                $.ajax({
                    type: 'post',
                    url: 'views/modules/Reportes/busquedaVentaMesas.php',
                    data: { "columna": "forma_pago_m", "valor": $("#v_forma_pago_m").val(), "tipo": "" },
                    dataType: "html",
                    success: function (resp) {
                        $('#tabla_ventas_mesas').html(resp);
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert("Status: " + textStatus); alert("Error: " + errorThrown);
                    }
                });
                return false;
                break;
            case "num_mesa":
                $.ajax({
                    type: 'post',
                    url: 'views/modules/Reportes/busquedaVentaMesas.php',
                    data: { "columna": "id_mesa_venta_m", "valor": $("#v_id_mesa_venta_m").val(), "tipo": "int" },
                    dataType: "html",
                    success: function (resp) {
                        $('#tabla_ventas_mesas').html(resp);
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert("Status: " + textStatus); alert("Error: " + errorThrown);
                    }
                });
                return false;
                break;
            case "fecha_venta_m":
                fecha_inicio = $("#v_fecha_venta_m_i").val();
                fecha_termino = $("#v_fecha_venta_m_f").val();
                $.ajax({
                    type: 'post',
                    url: 'views/modules/Reportes/busquedaVentaMesas.php',
                    data: { "fecha_inicio": fecha_inicio, "fecha_termino": fecha_termino, "tipo": "fecha" },
                    dataType: "html",
                    success: function (resp) {
                        $('#tabla_ventas_mesas').html(resp);
                        alert(resp);
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert("Status: " + textStatus); alert("Error: " + errorThrown);
                    }
                });
                return false;
                break;
        }
    });

});

function salir() {
    swal({
        title: "¿Deseas Cerrar Sesión?",
        text: "Estás por salir del sistema.",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Continuar",
        closeOnClickOutside: false,
        closeOnEsc: false,
        allowOutsideClick: false,
    }).then(function (result) {
        if (result.value) {
            swal({
                title: "Adios",
                text: "Saliendo del sistema .....",
                type: "success",
                closeOnClickOutside: false,
                closeOnEsc: false,
                allowOutsideClick: false,
            }).then(function (result) {
                if (result.value) {
                    location.href = "index.php?action=salir";
                }
            });
        } else {
            swal("No se ha cerrado sesión", "Sigamos trabajando.", "error");
            delay(2000);
        }
    });
}

function soloNumeros(e) {
    var key = window.Event ? e.which : e.keyCode
    return ((key >= 48 && key <= 57) || (key == 8))
}

//Funcion para abrir ventana
function ventanaPopup(URL) {
    var vp = window.open(URL, "", "width=1100,height=850,scrollbars=NO,top=50,left=100");
    vp.focus();
}

function clickactionEliminar(b) {
    document.getElementById('id_registro_borrar').value = b.id;
    document.getElementById('os').innerHTML = b.dataset.valor + "?";
}

function clickactionVentaNvaMesa(a){
    document.getElementById('os').innerHTML = document.getElementById('id_mesa_venta_m').value + "?";
}

function cancelarPartida(a) {
    $.ajax({
        type: 'post',
        url: 'views/modules/Ventas/cancelarPartidaVentaCliente.php',
        data: { "id_partida_venta_cliente": a.id, "estado_partida": "cancelado", "subtotal_partida": a.dataset.subtotal_p, "id_venta": a.dataset.id_venta, "total_venta": a.dataset.total_venta },
        dataType: "html",
        success: function (resp) {
            if (resp == "success")
                window.location.reload();
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus); alert("Error: " + errorThrown);
        }
    });
    return false;
}


function activarPartida(a) {
    $.ajax({
        type: 'post',
        url: 'views/modules/Ventas/cancelarPartidaVentaCliente.php',
        data: { "id_partida_venta_cliente": a.id, "estado_partida": "pendiente", "subtotal_partida": a.dataset.subtotal_p, "id_venta": a.dataset.id_venta, "total_venta": a.dataset.total_venta },
        dataType: "html",
        success: function (resp) {
            if (resp == "success")
                window.location.reload();
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus); alert("Error: " + errorThrown);
        }
    });
    return false;
}

function EliminarPartida(b) {
    document.getElementById('id_registro_borrar').value = b.id;
    document.getElementById('os').innerHTML = b.dataset.valor + "?";
    document.getElementById('id_venta').value = b.dataset.id_venta;
    document.getElementById('subtotal_p').value = b.dataset.subtotal_p;
    document.getElementById('total_venta').value = b.dataset.total_venta;
}

function clickactionPagar(b) {
    document.getElementById('id_venta_cobrar').value = b.id;
    document.getElementById('os').innerHTML = b.dataset.valor + "?";
    document.getElementById('total_venta').value = b.dataset.total;    
}


function mostrarPass1() {
    var x = document.getElementById("pass1");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function mostrarPass2() {
    var x = document.getElementById("pass2");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function preguntar(event) {
    event.preventDefault();
    swal({
        title: "Deseas realizar el cobro?",
        text: "Revisa que si la forma de pago es mixta no esten los valores en cero!",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#198754",
        confirmButtonText: "Cobrar",
        closeOnClickOutside: false,
        closeOnEsc: false,
        allowOutsideClick: false,
    }).then(function (result) {
        if (result.value) {
            swal({
                title: "Cuenta Cobrada",
                text: "Success .....",
                type: "success",
                closeOnClickOutside: false,
                closeOnEsc: false,
                allowOutsideClick: false,
            }).then(function (result) {
                if (result.value) {
                    var form = $('#form-cobrar');
                    form.submit();
                    ventanaNueva();
                }
            });
        } else {
            swal({
                title: "No se ha cobrado",
                text: "Sigamos trabajando",
                type: "error",
                timer: 2000
            });
        }
    });
}

function ventanaNueva(documento) {
    var id_venta_m = $("#id_venta_m").val();
    var id_mesa_venta_m = $("#id_mesa_venta_m").val();
    window.open('index.php?action=ticket&id_venta_m=' + id_venta_m + '&id_mesa=' + id_mesa_venta_m, 'nuevaVentana', 'width=350, height=600');
}


function imprimir(event) {
    event.preventDefault();
    swal({
        title: "¿Deseas Imprimir el ticket?",
        text: "",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#198754",
        confirmButtonText: "Imprimir",
        closeOnClickOutside: false,
        closeOnEsc: false,
        allowOutsideClick: false,
    }).then(function (result) {
        if (result.value) {
            ticketCliente();
            location.href = "index.php?action=menuPrincipal";
        } else {
            swal({
                title: "Cancelado",
                text: "Sigamos trabajando",
                type: "error",
                timer: 2000
            });
        }
    });
}

function ticketCliente(documento) {
    var id_venta_c = $("#id_venta_c").val();
    var id_cliente_venta_c = $("#id_cliente_venta_c").val();
    window.open('index.php?action=ticketCliente&id_venta_c=' + id_venta_c + '&id_cliente_venta_c=' + id_cliente_venta_c, 'Ticket Cliente', 'width=350, height=600');
}

function corteDelDiaMesas(documento) {
    window.open('index.php?action=corteDelDia', 'Corte Mesas', 'width=350, height=600');
}

function corteDelDiaClientes(documento) {
    window.open('index.php?action=corteCajaClientes', 'Corte Clientes', 'width=350, height=600');
}

function corteDelDiaGral(documento) {
    window.open('index.php?action=corteCajaGeneral', 'Corte General', 'width=350, height=600');
}

/*FUNCION PARA MOSTRAR LOS PRODUCTOS*/
function mostrarProductos(b){
    var dataen = 'id_categoria=' + b.id;
    
    $.ajax({
        type:'post',
        url:'views/modules/Ventas/obtenerProductosId.php',
        data: dataen, 
        dataType: "html",     
        success: function(resp){      
            $('#panel-categorias').css('display', 'none');      
            $("#productos-id").html(resp);
            $('#productos-id').css('display', 'flex');   
        }
    });
    return false;
}


/*FUNCION PARA MOSTRAR LOS PRODUCTOS*/
function agregarProductoVenta(b){
    document.getElementById('id_prod_venta').value = b.dataset.id_prod;
    $('#agregarProducto').submit(); 
}

function calcular(a){
    var lstNumero = document.getElementsByClassName("array_importes");
    var imp_abono = document.getElementById("importe_abono").value;
    var id_usuario = document.getElementById("id_usuario").value;
    let ventas = []; let importes = []; let abonos = [];
    for (var i = 0; i < lstNumero.length; i++) {   
        if(imp_abono > 0){
            if(lstNumero[i].dataset.saldo_ant === ""){ //VALIDAMOS SI EL IMPORTE DE SALDO ANTERIOR ES NULL
            
                if(imp_abono >= lstNumero[i].dataset.importe){ //VALIDAMOS SI EL IMPORTE ES IGUAL A LA CUENTA O MAYOR           
                    alert("COMPLETA");
                    $.ajax({
                        type:'post',
                        url:'views/modules/Reportes/pagarCuentaCompleta.php',
                        data: { "id_venta_cobrar": lstNumero[i].value, "total_venta": lstNumero[i].dataset.importe, "id_usuario": id_usuario}, 
                        dataType: "html",     
                        success: function(resp){      }
                    });
                    imp_abono = imp_abono - lstNumero[i].dataset.importe;
                    ventas[i] = lstNumero[i].value;
                    importes[i] = lstNumero[i].dataset.importe;
                    abonos[i] = lstNumero[i].dataset.importe;
                }else{
                    alert("ABONO");
                    $.ajax({
                        type: 'POST',
                        url: 'views/modules/Reportes/abonarCuenta.php',
                        data: { "id_venta_cliente": lstNumero[i].value, "imp_abono": imp_abono, "id_usuario": id_usuario, "saldo_anterior": lstNumero[i].dataset.importe},
                        dataType: 'html',
                        success: function(resp){}
                    });
                    abonos[i] = imp_abono;
                    imp_abono = imp_abono - lstNumero[i].dataset.importe;
                    ventas[i] = lstNumero[i].value;
                    importes[i] = lstNumero[i].dataset.importe;
                }
            }else{ 
                alert("COMPLETA - ABONO");
                $.ajax({
                    type:'post',
                    url:'views/modules/Reportes/pagarPendienteCuenta.php',
                    data: { "id_venta_cobrar": lstNumero[i].value, "total_venta": lstNumero[i].dataset.saldo_ant, "id_usuario": id_usuario}, 
                    dataType: "html",     
                    success: function(resp){}
                });
                abonos[i] = lstNumero[i].dataset.saldo_ant;
                imp_abono = imp_abono - lstNumero[i].dataset.saldo_ant;
                ventas[i] = lstNumero[i].value;
                importes[i] = lstNumero[i].dataset.importe;
                alert("Restan " + imp_abono);
            }
        }else{}
    }
    var ventana =  window.open('index.php?action=abonoCuenta&array_venta='+ btoa(JSON.stringify(ventas))+'&array_importes=' + btoa(JSON.stringify(importes)) + '&array_abonos=' + btoa(JSON.stringify(abonos)) + '&id_usuario=' + btoa(id_usuario), 'Corte Mesas', 'width=350, height=600');
    ventana.onload = function() {
        // Ya se cargó la página y se puede asignar el evento final
        ventana.onunload = function() {
            window.location.reload();
        }
    }
}