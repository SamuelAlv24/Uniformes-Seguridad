<?php

require '../../Conexion.php';
require '../../Header_extra_new.php';

$consulta = sqlsrv_query($conn, "SELECT * FROM usuarios WHERE usuario_usuario='" . $_SESSION["username"] . "'");
while ($resultado = sqlsrv_fetch_array($consulta)) {
    $nombreUsuario = $resultado['nombre_usuario'];
    $idusuario = $resultado['id_usuario'];
}
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

?>

<!-- <script src="../npm/node_modules/pushjs/bin2/push.js"></script> -->

<link rel="stylesheet" href="../../LAMM/css/alertify.css">
    <link rel="stylesheet" href="../../LAMM/css/bootstrap.css">
    <link rel="stylesheet" href="../../LAMM/DataTables/datatables.min.css">
    <link rel="stylesheet" href="../../LAMM/DataTables/DataTables-1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../../LAMM/DataTables/Buttons-2.2.3/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="../../LAMM/DataTables/FixedHeader-3.2.4/css/fixedHeader.bootstrap5.min.css">


    <link rel="stylesheet" href="../../LAMM/css/themes/bootstrap.min.css">
    <link rel="stylesheet" href="../../LAMM/css/fa-all.min.css">
    <link rel="stylesheet" href="../../LAMM/css/select2.min.css">
    <link rel="stylesheet" href="../../LAMM/css/style.css">
    
<style>
    .seccion-cont {
        margin: 20px;
        min-width: 80%;
        min-height: 80%;
    }

    .left-local {

        width: 30%;
    }

    .ajs-warning{
        background: rgb(231 121 44 / 95%) !important;
    }

    @media screen and (max-height: 800px) {

        .seccion-cont {
            margin: 20px;
            min-width: 100%;
            min-height: 100%;
            display: inline-block;
        }

        .left-local {

            width: 100%;
        }

        #formUniformes {
            width: 100%;
        }

        #secTablaUniformes {
            width: 100%;
        }

        #formSeguridad {
            width: 100%;
        }

        #secTablaSeguridad {
            width: 100%;
        }
    }

    @media screen and (max-width: 1300px) {

        .seccion-cont {
            margin: 20px;
            min-width: 100%;
            min-height: 100%;
            display: inline-block;
        }

        .left-local {

            width: 100%;
        }

        #formUniformes {
            width: 100%;
        }

        #secTablaUniformes {
            width: 100%;
        }

        #formSeguridad {
            width: 100%;
        }

        #secTablaSeguridad {
            width: 100%;
        }
    }

    .input, input, select .select2-container{
        height: 50px !important;
    }

</style>

<script src="../../LAMM/js/jquery.js"></script>
<script src="../../LAMM/DataTables/datatables.min.js"></script>
    <script src="../../LAMM/DataTables/DataTables-1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="../../LAMM/DataTables/Buttons-2.2.3/js/buttons.bootstrap5.min.js"></script>
    <script src="../../LAMM/DataTables/FixedHeader-3.2.4/js/fixedHeader.bootstrap5.min.js"></script>
    <script src="../../LAMM/js/xlsx.min.js"></script>
    <script src="../../LAMM/js/pdfmake.js"></script>
    <script src="../../LAMM/js/vfsfonts.js"></script>
    <script src="../../LAMM/js/alertify.js"></script>
    <script src="../../LAMM/js/fa-all.min.js"></script>
    <script src="../../LAMM/js/select2.min.js"></script>
    <script>
        alertify.defaults.transition = "slide";
        alertify.defaults.theme.ok = "btn btn-primary";
        alertify.defaults.theme.cancel = "btn btn-danger";
        alertify.defaults.theme.input = "form-control";
    </script>

<div class="panel-heading" style="background-color:#001842;">
    <h1 class="text-center text-white text-uppercase tit" style="color: #F5F5F5; padding:3px; margin:0">Registros</h1>
</div>

<div class="imssa-contenido">
    <div class="seccion-cont">
        <div class="col-md-12 left-local">

            <form class="column" id="formUniformes" style="display: none; width:90%; margin-left:5%;">
                <div style="text-align: center;">
                    <h1>Uniformes</h1>
                </div>
                <br>
                <div class="form-group cod ctrl" style="width: 48%; float:left;">
                    <label for="" class="ctrl-label">Codigo de Empleado:</label>
                    <select name="codigoEmpleado" id="codigoEmpleado">
                        <option value="" selected> Buscar... </option>
                    </select>
                </div>

                <div class="im-w-100 form-group" style="width: 48%; float:right;">
                    <div class="ctrl">
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre y Apellido" readonly>
                        <label for="" class="ctrl-label">Nombre</label>
                    </div>
                </div>

                <div class="im-w-100 form-group" style="width: 48%; float:left;">
                    <div class="ctrl">
                        <input type="text" name="sexo" id="sexo" class="form-control" placeholder="Sexo" readonly>
                        <label for="" class="ctrl-label">Sexo</label>
                    </div>
                </div>

                <div class="im-w-100 form-group" style="width: 48%; float:right;">
                    <div class="ctrl">
                        <input type="text" name="departamento" id="departamento" class="form-control" placeholder="Departamento" readonly>
                        <label for="" class="ctrl-label">Departamento</label>
                    </div>
                </div>

                <div class="im-w-100 form-group" style="width: 48%; float:left;">
                    <div class="ctrl">
                        <input type="text" name="talla" id="talla" class="form-control" placeholder="Indique la talla" value="0">
                        <label for="" class="ctrl-label">Talla</label>
                    </div>
                </div>

                <div class="im-w-100 form-group" style="width: 48%; float:right;">
                    <div class="ctrl">
                        <input type="number" name="cantCamisasBotones" id="cantCamisasBotones" class="form-control" placeholder="Indique la cantidad de Camisas de Botones" value="0" min="0">
                        <label for="" class="ctrl-label">Cantidad de Camisas de Botones:</label>
                    </div>
                </div>

                <div class="im-w-100 form-group" style="width: 48%; float:left;">
                    <div class="ctrl">
                        <input type="number" name="cantCamisasPolo" id="cantCamisasPolo" class="form-control" placeholder="Indique la cantidad de Camisas Polo" value="0" min="0">
                        <label for="" class="ctrl-label">Cantidad de Camisas Polo:</label>
                    </div>
                </div>

                <div class="im-w-100 form-group" style="width: 48%; float:right;">
                    <div class="ctrl">
                        <input type="number" name="cantCamisasOtros" id="cantCamisasOtros" class="form-control" placeholder="Insique la cantidad de Otras Camisas" value="0" min="0">
                        <label for="" class="ctrl-label">Cantidad de Otras Camisas:</label>
                    </div>
                </div>

                <div class="" style="width: 48%; float:left;">
                    <div class="ctrl">
                        <select name="periodoMes" id="periodoMes" value="ENERO">
                            <option value="ENERO">ENERO</option>
                            <option value="FEBRERO">FEBRERO</option>
                            <option value="MARZO">MARZO</option>
                            <option value="ABRIL">ABRIL</option>
                            <option value="MAYO">MAYO</option>
                            <option value="JUNIO">JUNIO</option>
                            <option value="JULIO">JULIO</option>
                            <option value="AGOSTO">AGOSTO</option>
                            <option value="SEPTIEMBRE">SEPTIEMBRE</option>
                            <option value="OCTUBRE">OCTUBRE</option>
                            <option value="NOVIEMBRE">NOVIEMBRE</option>
                            <option value="DICIEMBRE">DICIEMBRE</option>
                        </select>
                        <label for="" class="ctrl-label">Periodo-Mes:</label>
                    </div>
                </div>

                <div class=" im-right" style="width: 48%; float:right;">
                    <div class="ctrl">
                        <select name="periodoAno" id="periodoAno" value="2022">
                        </select>
                        <label for="" class="ctrl-label">Periodo-A&ntilde;o:</label>
                    </div>
                </div>

                <div style="text-align: center;">
                    <button style="margin: auto; margin-top: 3%;" name="insert" id="insert" class="btn btn-success">Ingresar</button>
                </div>
                
                <div style="float:left; margin: 2% 0% 0% 35%;">
                    <button name="subirEdit" id="subirEdit" class="btn btn-success">Editar</button>
                </div>
                <div style="float:right; margin: 2% 35% 0% 0%;">
                    <button name="cancelEdit" id="cancelEdit"class="btn btn-danger">Cancelar</button>
                </div>
            </form>
            
        </div>
        <div id="secTablaUniformes" class="im-w-70" style="width: 100%;">

        </div>
    </div>

    <hr>

    <div class="seccion-cont">
        <div class="col-md-12 left-local">
            <form class="column" id="formSeguridad" style="display: none; width:90%; margin-left:5%;">
                <div style="text-align: center;">
                    <h1>Equipo de Proteccion</h1>
                </div>
                
                <div class="form-group cod ctrl" style="width: 48%; float:left;">
                    <label for="" class="ctrl-label">Codigo de Empleado:</label>
                    <select name="codigoEmpleado2" id="codigoEmpleado2">
                        <option value="" selected> Buscar... </option>
                    </select>
                </div>

                <div class="im-w-100 form-group" style="width: 48%; float:right;">
                    <div class="ctrl">
                        <input type="text" name="nombre2" id="nombre2" class="form-control" placeholder="Nombre y Apellido" readonly>
                        <label for="" class="ctrl-label">Nombre</label>
                    </div>
                </div>

                <div class="im-w-100 form-group" style="width: 48%; float:left;">
                    <div class="ctrl">
                        <input type="text" name="sexo2" id="sexo2" class="form-control" placeholder="Sexo" readonly>
                        <label for="" class="ctrl-label">Sexo</label>
                    </div>
                </div>

                <div class="im-w-100 form-group" style="width: 48%; float:right;">
                    <div class="ctrl">
                        <input type="text" name="departamento2" id="departamento2" class="form-control" placeholder="Departamento" readonly>
                        <label for="" class="ctrl-label">Departamento</label>
                    </div>
                </div>

                <div class="im-w-100 form-group" style="width: 48%; float:left;">
                    <div class="ctrl">
                        <input type="number" name="tallaMX" id="tallaMX" class="form-control" placeholder="Indique la talla Mexicana" value="0">
                        <label for="" class="ctrl-label">Talla MX</label>
                    </div>
                </div>

                <div class="im-w-100 form-group" style="width: 48%; float:right;">
                    <div class="ctrl">
                        <input type="number" name="tallaUS" id="tallaUS" class="form-control" placeholder="Indique la talla Estadounidense" value="0">
                        <label for="" class="ctrl-label">Talla US</label>
                    </div>
                </div>

                <div class="im-w-100 form-group" style="width: 48%; float:left;">
                    <div class="ctrl">
                        <select name="periodoMes2" id="periodoMes2" value="ENERO">
                            <option>----</option>
                            <option value="ENERO">ENERO</option>
                            <option value="FEBRERO">FEBRERO</option>
                            <option value="MARZO">MARZO</option>
                            <option value="ABRIL">ABRIL</option>
                            <option value="MAYO">MAYO</option>
                            <option value="JUNIO">JUNIO</option>
                            <option value="JULIO">JULIO</option>
                            <option value="AGOSTO">AGOSTO</option>
                            <option value="SEPTIEMBRE">SEPTIEMBRE</option>
                            <option value="OCTUBRE">OCTUBRE</option>
                            <option value="NOVIEMBRE">NOVIEMBRE</option>
                            <option value="DICIEMBRE">DICIEMBRE</option>
                        </select>
                        <label for="" class="ctrl-label">Periodo-Mes:</label>
                    </div>
                </div>

                <div class="im-w-100 form-group" style="width: 48%; float:right;">
                    <div class="ctrl">
                        <select name="periodoAno2" id="periodoAno2" value="2021">
                            <option>----</option>
                        </select>
                        <label for="" class="ctrl-label">Periodo-A&ntilde;o:</label>
                    </div>
                </div>
 
                <div class="im-w-100 form-group" style="width: 60%; float:left; margin-left:20%;">
                    <div class="ctrl">
                        <input type="text" name="observaciones" id="observaciones" class="form-control" placeholder="Observaciones" value="NO PEDIDO">
                        <label for="" class="ctrl-label">Observaciones</label>
                    </div>
                </div>

                <div  style="text-align: center;">
                    <button style="margin: auto; margin-top: 10%;" name="insert2" id="insert2" class="btn btn-success">Ingresar</button>
                </div>

                <div style="float:left; margin: 7% 0% 0% 0%;">
                    <button name="subirEdit2" id="subirEdit2" class="btn btn-success">Editar2</button>
                </div>
                <div style="float:right; margin: 7% 0% 0% 0%;">
                    <button name="cancelEdit2" id="cancelEdit2" class="btn btn-danger">Cancelar</button>
                </div>

            </form>
        </div>
        <div id="secTablaSeguridad" class="im-w-70" style="width: 100%;">

        </div>
    </div>
</div>
<!--*************************************************** Script Uniformes ***************************************************-->
<script>
    let id_actual;

    function dibujarTabla() {
        $.ajax({
            url: "query.php",
            type: 'POST',
            data: {
                operacion: "dibujarTabla",
            },
            success: function(result) {

                $('#secTablaUniformes').html(result);
            }
        });
    }

    function agregar_uniforme(){

        cancelarEdit();

        $("#subirEdit").hide();
        $("#cancelarEdit").hide();
        $("#insert").show();

        $('#formUniformes').show();
        
        alertify.genericDialogU($('#formUniformes')[0]).set({
            transition: 'zoom',
            width: '80%',
            heigth: '80%',
            resizable: true
        }).resizeTo('50%', 480);
    }

        /* Subir Datos */
    
    $('#insert').click( function (e){
        e.preventDefault();

        $("#subirEdit").hide();
        $("#cancelarEdit").hide();
        $("#insert").show();

        console.log("<?php echo $nombreUsuario; ?>");

        alertify.confirm('Se subira el nuevo registro a la tabla', 'Continuar ??', function() {
            // Codigo al confirmar

            var datosFormulario = new FormData(document.getElementById("formUniformes"));
            datosFormulario.append("operacion", "subirDatos");
            datosFormulario.append("nombreUsuario", "<?php echo $nombreUsuario; ?>");

            $.ajax({
                url: 'query.php',
                type: 'POST',
                data: datosFormulario,
                processData: false,
                contentType: false,
                success: function(result) {

                    alertify.alert("Datos insertados");
                    dibujarTabla();
                    alertify.closeAll();
                    cancelarEdit();
                }
            });

        }, function() {
            //codigo al cancelar
        });
    });
    

    /* Al darle editar aparecen los datos de la tabla en el formulario */
    function editar(id) {

        id_actual = id;

        $("#subirEdit").show();
        $("#cancelarEdit").show();
        $("#insert").hide();

        $('#formUniformes').show();
        
        alertify.genericDialogEU($('#formUniformes')[0]).set({
            transition: 'zoom',
            width: '80%',
            heigth: '80%',
            resizable: true
        }).resizeTo('50%', 480);

        $.ajax({
            url: "query.php",
            type: "POST",
            data: {
                operacion: 'editar',
                ID: id,
            },
            dataType: "json",
            success: function(result) {

                $("#codigoEmpleado").val(result.CodigoEmpleado);
                /* $("#codigoEmpleado").prop('disabled', true); */
                $("div.cod").css("pointer-events", "none");

                console.log("CE ::: " + $('#codigoEmpleado').val());

                $("#codigoEmpleado").select2({
                    width: '100%',
                    height: '100%'
                });

                console.log("CE ::: " + $('#codigoEmpleado').val());

                $("#nombre").val(String(result.Nombre));
                $("#sexo").val(String(result.Sexo));
                $("#departamento").val(String(result.Departamento));
                $("#talla").val(String(result.Talla));
                $("#cantCamisasBotones").val(String(result.CantCamisasBotones));
                $("#cantCamisasPolo").val(String(result.CantCamisasPolo));
                $("#cantCamisasOtros").val(String(result.CantCamisasOtros));
                /* $("#codigoEmpleado").val(String(result.Periodo)); */

                var periodoTXT = String(result.Periodo);
                var arr = periodoTXT.split('/');
                var mes = arr[0];
                var anio = arr[1];

                console.log("MES ::: " + mes);
                console.log("ANIO :::" + anio);

                $("#periodoMes option[value='" + mes + "']").prop('selected', true);
                $("#periodoMes").val(mes);
                $("#periodoAno option[value='" + anio + "']").prop('selected', true);
                $("#periodoAno").val(anio);

                $("#periodoAno").select2({
                    width: '100%',
                    height: '100%'
                });

                
                console.log("CE ::: " + $('#codigoEmpleado').val());
            }
        });

    }

    /* Subir el edit */
    $('#subirEdit').click( function (e) {

        e.preventDefault();

        alertify.confirm('Se subira el nuevo edit a la tabla', 'Continuar ??', function() {
            console.log("AS ::: " + $('#codigoEmpleado').val());
            console.log("PA ::: " + $('#periodoAno').val());
            var id_final = id_actual;
            var datosFormulario = new FormData(document.getElementById("formUniformes"));
            datosFormulario.append("operacion", "subirEdit");
            datosFormulario.append("nombreUsuario", "<?php echo $nombreUsuario; ?>");
            datosFormulario.append("ID", id_final);

            $.ajax({
                url: "query.php",
                type: 'POST',
                data: datosFormulario,
                processData: false,
                contentType: false,
                success: function(result) {

                    console.log("CE ::: " + $('#codigoEmpleado').val());
                    console.log("PA ::: " + $('#periodoAno').val());
                    alertify.alert("Datos Editados " + result);
                    dibujarTabla();
                    alertify.closeAll();
                    cancelarEdit();
                }
            });

        }, function() {
            //codigo al cancelar
        });

    });

    /* Cancelar el edit */
    function cancelarEdit () {

        /* e.preventDefault(); */

        /* $('#codigoEmpleado input').removeAttr('readonly', 'readonly'); */

        $("#subirEdit").hide();
        $("#cancelarEdit").hide();
        $("#insert").show();

        /* $("#codigoEmpleado").prop('disabled', false); */
        $("div.cod").css("pointer-events", "auto");
        $("#codigoEmpleado").css("pointer-events", "auto");
        $("#codigoEmpleado").select2({
            width: '100%',
            height: '100%'
        }).val("");
        $("#codigoEmpleado").select2({
            width: '100%',
            height: '100%'
        }).val("");
        $("#nombre").val(String(""));
        $("#sexo").val(String(""));
        $("#departamento").val(String(""));
        $("#talla").val(String("0"));
        $("#cantCamisasBotones").val(String("0"));
        $("#cantCamisasPolo").val(String("0"));
        $("#cantCamisasOtros").val(String("0"));

        $("#periodoMes option[value='ENERO']").prop('selected', true);
        $("#periodoAno option[value='']").prop('selected', true);
        alertify.closeAll();
    }

    $('#cancelEdit').click( function (e){

        e.preventDefault(); 
        cancelarEdit();
    });
    
    /* $('#cancelEdit').click(function (e) {

        e.preventDefault();

        /* $('#codigoEmpleado input').removeAttr('readonly', 'readonly');

        $("#subirEdit").hide();
        $("#cancelarEdit").hide();
        $("#insert").show();

        /* $("#codigoEmpleado").prop('disabled', false);
        $("div.cod").css("pointer-events", "auto");
        $("#codigoEmpleado").css("pointer-events", "auto");
        $("#codigoEmpleado").select2({
            width: '100%',
            height: '100%'
        }).val("");
        $("#codigoEmpleado").select2({
            width: '100%',
            height: '100%'
        }).val("");
        $("#nombre").val(String(""));
        $("#sexo").val(String(""));
        $("#departamento").val(String(""));
        $("#talla").val(String("0"));
        $("#cantCamisasBotones").val(String("0"));
        $("#cantCamisasPolo").val(String("0"));
        $("#cantCamisasOtros").val(String("0"));

        $("#periodoMes option[value='ENERO']").prop('selected', true);
        $("#periodoAno option[value='']").prop('selected', true);
        alertify.closeAll();
    }); */

    /* Eliminar registro */
    function eliminar(id) {

        alertify.confirm('Se Eliminara el registro de la tabla', 'Continuar ??', function() {

            $.ajax({
                url: "query.php",
                type: "POST",
                data: {
                    operacion: 'eliminar',
                    ID: id,
                },
                success: function(result) {

                    alertify.alert("Datos Eliminados");
                    dibujarTabla();
                }
            });

        }, function() {
            //codigo al cancelar
        });
    }

    function consultarNotificaciones() {
        $.ajax({
            url: "query.php",
            type: 'POST',
            data: {
                operacion: "consultarNotificaciones",
            },
            /* dataType: "json", */
            success: function(result) {
                console.log(result);
                /* var html = "<option value='";
                var i = 0;
                // $('#codigoEmpleado').append("<option value='" + result[x] + "'>" + result[x] + result[x + 1] + result[x + 2] +"</option>"); 
                for (var x in result) {
                    i++;
                    if (i == 1) {
                        html += result[x] + "'>" + result[x];
                    }
                    if (i == 2) {
                        html += " " + result[x] + " ";
                    }
                    if (i == 3) {
                        html += result[x] + "</option>";
                        $('#codigoEmpleado').append(html);
                        console.log(html);
                        html = "<option value='";
                        i = 0;
                    }
                } */
            }
        });
    }

    $(document).ready(function() {

        alertify.genericDialog || alertify.dialog('genericDialogU', function() {
            return {
                main: function(content) {
                    this.setContent(content);
                },
                setup: function() {
                    return {
                        focus: {
                            element: function() {
                                return this.elements.body.querySelector(this.get('selector'));
                            },
                            select: true
                        },
                        options: {
                            basic: true,
                            maximizable: false,
                            resizable: false,
                            padding: false
                        },
                    };
                },
                settings: {
                    selector: undefined
                }
            };
        });

    alertify.genericDialog || alertify.dialog('genericDialogEU', function() {
            return {
                main: function(content) {
                    this.setContent(content);
                },
                setup: function() {
                    return {
                        focus: {
                            element: function() {
                                return this.elements.body.querySelector(this.get('selector'));
                            },
                            select: true
                        },
                        options: {
                            basic: true,
                            maximizable: false,
                            resizable: false,
                            padding: false
                        },
                    };
                },
                settings: {
                    selector: undefined
                }
            };
        });

        consultarNotificaciones();

        $("#subirEdit").hide();
        $("#cancelarEdit").hide();

        var y = new Date().getFullYear();
        for (let i = 2021; i <= 2100; i++) {
            $('#periodoAno').append('<option value="' + i + '">' + i + '</option>');
        }

        $('#codigoEmpleado').select2({
            width: '100%',
            height: '100%',
            /* tags: true   (Sirve para agreagar cosas que no esta en la lista) */
        });

        $('#periodoAno').select2({
            width: '100%',
            height: '100%',
            /* tags: true   (Sirve para agreagar cosas que no esta en la lista) */
        });


        /* Codigo de empleado */
        $.ajax({
            url: "query.php",
            type: 'POST',
            data: {
                operacion: "obCodEmpleado",
            },
            dataType: "json",
            success: function(result) {
                var html = "<option value='";
                var i = 0;
                /* $('#codigoEmpleado').append("<option value='" + result[x] + "'>" + result[x] + result[x + 1] + result[x + 2] +"</option>"); */
                for (var x in result) {
                    i++;
                    if (i == 1) {
                        html += result[x] + "'>" + result[x];
                    }
                    if (i == 2) {
                        html += " " + result[x] + " ";
                    }
                    if (i == 3) {
                        html += result[x] + "</option>";
                        $('#codigoEmpleado').append(html);
                        /* console.log(html); */
                        html = "<option value='";
                        i = 0;
                    }
                }
            }
        });

        dibujarTabla();



    });

    /* obtener datos de empleado a formulario */
    $("#codigoEmpleado").change(function() {
        var codEmpleado = $('#codigoEmpleado').val();
        console.log(codEmpleado);
        $.ajax({
            url: "query.php",
            type: 'POST',
            data: {
                operacion: "obNomSex",
                codigoEmpleado: codEmpleado,
            },
            dataType: "json",
            success: function(result) {

                $('#nombre').val(result.Nombre + " " + result.ApellidoPaterno);

                if (result.Sexo == "MASCULINO") {
                    $('#sexo').val('Hombre');
                } else {
                    $('#sexo').val('Mujer');
                }
                $('#departamento').val(result.Departamento);
            }
        });
    });
</script>


<!--********************************************* Script Equipo de Seguridad *********************************************-->

<script>

    function dibujarTabla2() {
        $.ajax({
            url: "query2.php",
            type: 'POST',
            data: {
                operacion: "dibujarTabla2",
            },
            success: function(result) {

                $('#secTablaSeguridad').html(result);
            }
        });
    }

    function agregar_equipoSeguridad(){

        cancelarEdit2();

        $("#subirEdit2").hide();
        $("#cancelarEdit2").hide();
        $("#insert2").show();

        $('#formSeguridad').show();
        
        alertify.genericDialogS($('#formSeguridad')[0]).set({
            transition: 'zoom',
            width: '80%',
            heigth: '80%',
            resizable: true
        }).resizeTo('50%', 480);
    }


    /* function consultarNotificaciones2() {

        $.ajax({
            url: "query2.php",
            type: 'POST',
            data: {
                operacion: "consultarNotificaciones",
            },
            dataType: "json",
            success: function(result) {

                console.log(result);

                /* $('#nombre2').val(result.nombre);
                $("#proximaEntrega").val(result.proximaEntrega);
                $('#codigoEmpleado').val(result.codigoEmpleado); */

                /* var nom = String(result.nombre);
                var cod = String(result.codigoEmpleado);
                var pe = String(result.proximaEntrega);
                var m = String(result.mes);
                var y = String(result.anio); */

                /* if(m=="JULIO"){
                    var m = "Jul";
                } */
                /* console.log(mes); */

                /* console.log(m+"/"+y); */
/* 
                switch (m) {
                    case "ENERO":
                        m = "01";
                        break;
                    case "FEBRERO":
                        m = "02";
                        break;
                    case "MARZO":
                        m = "03";
                        break;
                    case "ABRIL":
                        m = "04";
                        break;
                    case "MAYO":
                        m = "05";
                        break;
                    case "JUNIO":
                        m = "06";
                        break;
                    case "JULIO":
                        m = "07";
                        break;
                    case "AGOSTO":
                        m = "08";
                        break;
                    case "SEPTIEMBRE":
                        m = "09";
                        break;
                    case "OCTUBRE":
                        m = "10";
                        break;
                    case "NOVIENBRE":
                        m = "11";
                        break;
                    case "DICIEMBRE":
                        m = "12";
                        break;
                }

                var fecha = (m + "-01" + "-" + y);

                const date = new Date(fecha);

                let day = date.getDate();
                let month = date.getMonth() + 1;
                let year = date.getFullYear();

                console.log("Fecha :: :: " + date);
                console.log("Dia :: :: " + day);
                console.log("Mes :: :: " + month);
                console.log("Año :: :: " + year);

                /* let fechaF = strtotime(date); 
                let hoy = new Date();
                console.log("Hoy :: :: " + hoy);

                var diff = date - hoy;
                console.log(diff / (1000 * 60 * 60 * 24));

                if ((m == month) && (y == year)) {
                    alertify.success(nom + " " + cod + " " + fecha, 0);
                } else {
                    alertify.success("No es la misma Fecha", 0);
                }
            }
        });



        /* let nom = document.getElementById('nombre2').value;
        /* var nom = $('#nombre').val(),
            pfech = $("#proximaEntrega").val(),
            cod = $('#codigoEmpleado').val();
        console.log(nom); */

        /* alertify.error("45454", 0);

    } */

    $(document).ready(function() {

        alertify.genericDialog || alertify.dialog('genericDialogS', function() {
            return {
                main: function(content) {
                    this.setContent(content);
                },
                setup: function() {
                    return {
                        focus: {
                            element: function() {
                                return this.elements.body.querySelector(this.get('selector'));
                            },
                            select: true
                        },
                        options: {
                            basic: true,
                            maximizable: false,
                            resizable: false,
                            padding: false
                        },
                    };
                },
                settings: {
                    selector: undefined
                }
            };
        });

        alertify.genericDialog || alertify.dialog('genericDialogES', function() {
            return {
                main: function(content) {
                    this.setContent(content);
                },
                setup: function() {
                    return {
                        focus: {
                            element: function() {
                                return this.elements.body.querySelector(this.get('selector'));
                            },
                            select: true
                        },
                        options: {
                            basic: true,
                            maximizable: false,
                            resizable: false,
                            padding: false
                        },
                    };
                },
                settings: {
                    selector: undefined
                }
            };
        });

        /* consultarNotificaciones2(); */

        dibujarTabla2();

        $("#subirEdit2").hide();
        $("#cancelarEdit2").hide();

        var y = new Date().getFullYear();
        for (let i = 2022 - 1; i <= 2100; i++) {
            $('#periodoAno2').append('<option value="' + i + '">' + i + '</option>');
        }

        $('#codigoEmpleado2').select2({
            width: '100%',
            height: '100%',
            /* tags: true   (Sirve para agreagar cosas que no esta en la lista) */
        });

        $('#periodoAno2').select2({
            width: '100%',
            height: '100%',
            /* tags: true   (Sirve para agreagar cosas que no esta en la lista) */
        });


        $.ajax({
            url: "query2.php",
            type: 'POST',
            data: {
                operacion: "obCodEmpleado",
            },
            dataType: "json",
            success: function(result) {

                var html = "<option value='";
                var i = 0;
                /* $('#codigoEmpleado').append("<option value='" + result[x] + "'>" + result[x] + result[x + 1] + result[x + 2] +"</option>"); */
                for (var x in result) {
                    i++;
                    if (i == 1) {
                        html += result[x] + "'>" + result[x];
                    }
                    if (i == 2) {
                        html += " " + result[x] + " ";
                    }
                    if (i == 3) {
                        html += result[x] + "</option>";
                        $('#codigoEmpleado2').append(html);
                        html = "<option value='";
                        i = 0;
                    }
                }
            }
        });



        /* var periodoTXT = String(result.fechaEntrega);
                var arr = periodoTXT.split('/');
                var mes = arr[0];
                var anio = arr[1];



                console.log("MES ::: " + mes);
                console.log("ANIO :::" + anio);

                $("#periodoMes2 option[value='" + mes + "']").prop('selected', true);
                $("#periodoMes2").val(mes);
                $("#periodoAno2 option[value='" + anio + "']").prop('selected', true);
                $("#periodoAno2").val(anio);


                var fechaNot = new Date(mes);
                var mes = Navidad.getMonth(); */

        /* if(getMonth()=="Junio"){
            console.log("Si Funiciona");
        } */

        /* let date = new Date().toDateString(); */
        /* var mesActual = date.getMonth(); */
        /* var mes = new Date().getMonth();
        console.log(mes); */

        <?php /* notiSIIMSSA('success','Requisición Autorizada','Tu requisición con Folio #### ha sido autorizada el día dd/mm/aaaa','http://192.168.1.253:8080/AdministradorInsumos/requisiciones_compra.php','SISTEMAS','2150'); */ ?>


    });

    /* obtener datos de empleado a formulario */
    $("#codigoEmpleado2").change(function() {
        var codEmpleado = $('#codigoEmpleado2').val();

        $.ajax({
            url: "query2.php",
            type: 'POST',
            data: {
                operacion: "obNomSex",
                codigoEmpleado: codEmpleado,
            },
            dataType: "json",
            success: function(result) {

                $('#nombre2').val(result.Nombre + " " + result.ApellidoPaterno);

                if (result.Sexo == "MASCULINO") {
                    $('#sexo2').val('Hombre');
                } else {
                    $('#sexo2').val('Mujer');
                }
                $('#departamento2').val(result.Departamento);
            }
        });
    });

    /* Subir Datos */
    $("#insert2").click(function(e) {
        e.preventDefault();

        $("#subirEdit2").hide();
        $("#cancelarEdit2").hide();
        $("#insert2").show();

        console.log("<?php echo $nombreUsuario; ?>");

        alertify.confirm('Se subira el nuevo registro a la tabla', 'Continuar ??', function() {
            // Codigo al confirmar

            console.log($("#codigoEmpleado2").val());
            var datosFormulario = new FormData(document.getElementById("formSeguridad"));
            datosFormulario.append("operacion", "subirDatos");
            datosFormulario.append("nombreUsuario", "<?php echo $nombreUsuario; ?>");
            var proximaEntrega = String(parseInt($('#periodoAno2').val()) + 1);
            datosFormulario.append("anioProximaEntrega", proximaEntrega);

            $.ajax({
                url: 'query2.php',
                type: 'POST',
                data: datosFormulario,
                processData: false,
                contentType: false,
                success: function(result) {

                    alertify.alert("Datos insertados");
                    dibujarTabla2();
                    alertify.closeAll();
                    cancelarEdit2();
                }
            });

        }, function() {
            //codigo al cancelar
        });
    });

    /* Editar tabla */
    function editar2(id) {

        id_actual = id;

        $("#subirEdit2").show();
        $("#cancelarEdit2").show();
        $("#insert2").hide();

        $('#formSeguridad').show();
        
        alertify.genericDialogES($('#formSeguridad')[0]).set({
            transition: 'zoom',
            width: '80%',
            heigth: '80%',
            resizable: true
        }).resizeTo('50%', 480);

        $.ajax({
            url: "query2.php",
            type: "POST",
            data: {
                operacion: 'editar',
                ID: id_actual,
            },
            dataType: "json",
            success: function(result) {


                /* $('.codigoEmpleado option')
                    .removeAttr('selected')
                    .filter('[value=' + result.codigoEmpleado + ']')
                    .prop('selected', true); */
                $("#codigoEmpleado2").val(result.codigoEmpleado);
                /* $("#codigoEmpleado2").prop('disabled', true); */
                $("div.cod").css("pointer-events", "none");
                $("#codigoEmpleado2").select2({
                    width: '100%',
                    height: '100%'
                }).val(result.codigoEmpleado);

                $("#nombre2").val(String(result.nombre));
                $("#sexo2").val(String(result.sexo));
                $("#departamento2").val(String(result.departamento));
                $("#tallaMX").val(String(result.tallaMX));
                $("#tallaUS").val(String(result.tallaUS));
                $("#observaciones").val(String(result.observaciones));
                $("#fechaRegistro").val(String(result.fechaRegistro));
                $("#fechaEntrega").val(String(result.fechaEntrega));
                $("#proximaEntrega").val(String(result.proximaEntrega));
                /* $("#codigoEmpleado").val(String(result.Periodo)); */

                console.log(result.codigoEmpleado);
                console.log(result.nombre);
                console.log(result.sexo);
                console.log(result.departamento);
                console.log(result.tallaMX);
                console.log(result.tallaUS);
                console.log(result.observaciones);
                console.log(result.fechaRegistro);
                console.log(result.fechaEntrega);
                console.log(result.proximaEntrega);


                var periodoTXT = String(result.fechaEntrega);
                var arr = periodoTXT.split('/');
                var mes = arr[0];
                var anio = arr[1];



                console.log("MES ::: " + mes);
                console.log("ANIO :::" + anio);

                $("#periodoMes2 option[value='" + mes + "']").prop('selected', true);
                $("#periodoMes2").val(mes);
                $("#periodoAno2 option[value='" + anio + "']").prop('selected', true);
                $("#periodoAno2").val(anio);


                $("#periodoAno2").select2({
                    width: '100%',
                    height: '100%'
                });

                
            }, error: function (e) {
                console.log('ERROR :: ' + e);
            }
        }).fail( function( jqXHR, textStatus, errorThrown ) {
            console.log(jqXHR +"        "+ textStatus +"      "+ errorThrown);
        });
    }

    /* Subir la edicion a la tabla */
    $('#subirEdit2').click(function () {

        

        alertify.confirm('Se subira el nuevo edit a la tabla', 'Continuar ??', function() {

            var id_final = id_actual;
            var datosFormulario = new FormData(document.getElementById("formSeguridad"));
            var proximaEntrega = String(parseInt($('#periodoAno2').val()) + 1);
            datosFormulario.append("anioProximaEntrega", proximaEntrega);
            datosFormulario.append("operacion", "subirEdit");
            datosFormulario.append("nombreUsuario", "<?php echo $nombreUsuario; ?>");
            datosFormulario.append("ID", id_final);

            $.ajax({
                url: "query2.php",
                type: 'POST',
                data: datosFormulario,
                processData: false,
                contentType: false,
                success: function(result) {

                    alertify.alert("Datos Editados");
                    dibujarTabla2();
                    alertify.closeAll(); 
                    cancelarEdit2();
                }
            });

        }, function() {
            //codigo al cancelar
        });
    });



    /* Cancelar edit */
    /* $('#cancelarEdit2').click(function (e) { */

    function cancelarEdit2 () {

        /* e.preventDefault(); */

        $("#subirEdit2").hide();
        $("#cancelarEdit2").hide();
        $("#insert2").show();

        /*  $("#codigoEmpleado2").prop('disabled', false); */
        $("div.cod").css("pointer-events", "auto");
        $("#codigoEmpleado2").select2({
            width: '100%',
            height: '100%'
        }).val(" ");
        $("#nombre2").val(String(" "));
        $("#sexo2").val(String(" "));
        $("#departamento2").val(String(" "));
        $("#tallaMX").val(String("0"));
        $("#tallaUS").val(String("0"));
        $("#observaciones").val(String(" "));
        $("#fechaRegistro").val(String(" "));
        $("#fechaEntrega").val(String(" "));
        $("#proximaEntrega").val(String(" "));

        $("#periodoMes2 option[value='ENERO']").prop('selected', true);
        $("#periodoAno2 option[value='2022']").prop('selected', true);

        alertify.closeAll();
        /* cancelarEdit2(); */
    }

    $('#cancelEdit2').click( function (e){

        e.preventDefault(); 
        cancelarEdit2();
    });

    /* Eliminar datos de la tabla */
    function eliminar2(id) {

        alertify.confirm('Se Eliminara el registro de la tabla', 'Continuar ??', function() {

            $.ajax({
                url: "query2.php",
                type: "POST",
                data: {
                    operacion: 'eliminar2',
                    ID: id,
                },
                success: function(result) {

                    alertify.alert("Datos Eliminados");
                    dibujarTabla2();
                }
            });

        }, function() {
            //codigo al cancelar
        });
    }
</script>