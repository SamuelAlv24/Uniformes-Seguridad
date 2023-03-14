<?php
require '../../Conexion.php';

$operacion = $_POST['operacion'];

$codigoEmpleado = $_POST['codigoEmpleado'];
$nombre = $_POST['nombre'];
$sexo = $_POST['sexo'];
$departamento = $_POST['departamento'];
$talla = $_POST['talla'];
$cantCamisasBotones = $_POST['cantCamisasBotones'];
$cantCamisasPolo = $_POST['cantCamisasPolo'];
$cantCamisasOtros = $_POST['cantCamisasOtros'];
$periodoMes = $_POST['periodoMes'];
$periodoAno = $_POST['periodoAno'];

$nombreUsuario = $_POST['nombreUsuario'];
$ID = $_POST['ID'];



if ($operacion == "consultarNotificaciones") {

    /* notiSIIMSSA('success','Requisición Autorizada','Tu requisición con Folio #### ha sido autorizada el día dd/mm/aaaa','http://192.168.1.253:8080/AdministradorInsumos/requisiciones_compra.php','2150'); */
    if($conn){
        die("Connection.\n");
    }else if (!$conn) {
        die("Connection to MS SQL could not be established.\n");
    }

    $cons = "SELECT proximaEntrega FROM seguridadEquipo";
    $ejecutar = sqlsrv_query($conn, $cons);
    echo "Hola";

    /* if ($ejecutar === false) {
    die(print_r(sqlsrv_errors(), true));
    } */

    /* if ($ejecutar === false) {
        if (($errors = sqlsrv_errors()) != null) {
            foreach ($errors as $error) {
                echo "SQLSTATE: " . $error['SQLSTATE'] . "\n";
                echo "code: " . $error['code'] . "\n";
                echo "message: " . $error['message'] . "\n";
            }
        }
    } */


    while ($resultado = sqlsrv_fetch_array($ejecutar)) {
        echo $resultado['proximaEntrega'];
        /* $proximaEntrega = $resultado['proximaEntrega'];

    $separada = explode($separador, $proximaEntrega);
    var_dump($separada); */
    }
}


/* obtener datos de empleado a formulario */
if ($operacion == 'obNomSex') {
    $consulta = "SELECT Nombre, ApellidoPaterno, Sexo, Departamento FROM Empleados2 WHERE CodigoEmpleado = '$codigoEmpleado'";
    $ejecutar = sqlsrv_query($conn, $consulta);

    $rows = array();

    while ($fila = sqlsrv_fetch_array($ejecutar)) {
        $rows['Nombre'] = $fila['Nombre'];
        $rows['ApellidoPaterno'] = $fila['ApellidoPaterno'];
        $rows['Sexo'] = $fila['Sexo'];
        $rows['Departamento'] = $fila['Departamento'];
    }
    echo json_encode($rows);
}


/* Subir datos */
if ($operacion == "subirDatos") {

    $periodoTotal = $periodoMes . "/" . $periodoAno;
    echo $codigoEmpleado;
    $consulta = "INSERT INTO FormularioUniformes (CodigoEmpleado, Sexo, Talla, CantCamisasBotones, CantCamisasPolo, CantCamisasOtros, FechaEntrega, Periodo, Nombre, Usuario, Departamento) 
    VALUES ('$codigoEmpleado', '$sexo', '$talla', $cantCamisasBotones, $cantCamisasPolo, $cantCamisasOtros, getDate(), '$periodoTotal', '$nombre', '$nombreUsuario', '$departamento')";
    $ejecutar = sqlsrv_query($conn, $consulta);


    echo "<br>" . $consulta . "<br>";
    echo $ejecutar . "<br>";

    if ($ejecutar === false) {
        die(print_r(sqlsrv_errors(), true));
    }
}


/* obtener datos de la tabla a formulario */
if ($operacion == 'editar') {

    $consulta = "SELECT * FROM FormularioUniformes WHERE id = $ID";
    $ejecutar = sqlsrv_query($conn, $consulta);

    $rows = array();

    while ($fila = sqlsrv_fetch_array($ejecutar)) {
        $rows['CodigoEmpleado'] = $fila['CodigoEmpleado'];
        $rows['Nombre'] = $fila['Nombre'];
        $rows['Sexo'] = $fila['Sexo'];
        $rows['Departamento'] = $fila['Departamento'];
        $rows['Talla'] = $fila['Talla'];
        $rows['CantCamisasBotones'] = $fila['CantCamisasBotones'];
        $rows['CantCamisasPolo'] = $fila['CantCamisasPolo'];
        $rows['CantCamisasOtros'] = $fila['CantCamisasOtros'];
        $rows['FechaEntrega'] = $fila['FechaEntrega'];
        $rows['Periodo'] = $fila['Periodo'];
    }
    echo json_encode($rows);
}

/* Subir el edit */
if ($operacion == "subirEdit") {
    $periodoTotal = $periodoMes . "/" . $periodoAno;

    $consulta = "UPDATE FormularioUniformes SET CodigoEmpleado='$codigoEmpleado', Sexo='$sexo', 
    Talla='$talla', CantCamisasBotones=$cantCamisasBotones, CantCamisasPolo=$cantCamisasPolo, 
    CantCamisasOtros=$cantCamisasOtros, FechaEntrega=getDate(), Periodo='$periodoTotal', Nombre='$nombre', Usuario='$nombreUsuario', Departamento='$departamento' WHERE id=$ID";
    $ejecutar = sqlsrv_query($conn, $consulta);

    echo "<br>" . $consulta . "<br>";
    echo $ejecutar . "<br>";

    if ($ejecutar === false) {
        die(print_r(sqlsrv_errors(), true));
    }
}

/* Eliminar un registro */
if ($operacion == "eliminar") {

    $consulta = "DELETE FROM FormularioUniformes WHERE id=$ID";
    $ejecutar = sqlsrv_query($conn, $consulta);

    if ($ejecutar === false) {
        die(print_r(sqlsrv_errors(), true));
    }
}



/* Codigo de empleado */
if ($operacion == 'obCodEmpleado') {
    $consulta = "SELECT CodigoEmpleado, Nombre, ApellidoPaterno FROM Empleados2 WHERE Status = 'AC'";
    $ejecutar = sqlsrv_query($conn, $consulta);

    $rows = array();
    $i = 0;

    while ($fila = sqlsrv_fetch_array($ejecutar)) {
        $rows['codigoEmpleado' . $i] = $fila['CodigoEmpleado'];
        $rows['Nombre' . $i] = $fila['Nombre'];
        $rows['ApellidoPaterno' . $i] = $fila['ApellidoPaterno'];
        $i++;
    }
    echo json_encode($rows);
}

if ($operacion == 'dibujarTabla') {
?>
<style>
    table.dataTable.fixedHeader-floating,
    table.dataTable.fixedHeader-locked {
        margin-left: -1.5% !important;
    }
</style>
    <div style="text-align: center;">
        <h1>Uniformes</h1>
    </div>
    <table id="tablaUniformes" class="table-striped table-hover table" style="width:100%; text-align: center; padding: 20px 10px;">
        <thead style="background-color: #082954; color: white;">
            <th style="text-align:center;">id</th>
            <th style="text-align:center;">Codigo de Empleado</th>
            <th style="text-align:center;">Nombre</th>
            <th style="text-align:center;">Sexo</th>
            <th style="text-align:center;">Departamento</th>
            <th style="text-align:center;">Talla</th>
            <th style="text-align:center;">Camisas Botones</th>
            <th style="text-align:center;">Camisas Polo</th>
            <th style="text-align:center;">Camisas Otros</th>
            <th style="text-align:center;">Fecha Registro</th>
            <th style="text-align:center;">Periodo Entrega</th>
            <th style="text-align:center;">Opciones</th>
        </thead>
        <tbody>
            <?php
            $consulta = "SELECT * FROM FormularioUniformes";
            $ejecutar = sqlsrv_query($conn, $consulta);

            while ($fila = sqlsrv_fetch_array($ejecutar)) {
                $id = $fila['id'];
                $codigoEmpleado = $fila['CodigoEmpleado'];
                $nombre = $fila['Nombre'];
                $sexo = $fila['Sexo'];
                $departamento = $fila['Departamento'];
                $talla = $fila['Talla'];
                $cantCamisasBotones = $fila['CantCamisasBotones'];
                $cantCamisasPolo = $fila['CantCamisasPolo'];
                $cantCamisasOtros = $fila['CantCamisasOtros'];
                $fechaEntrega = $fila['FechaEntrega'];
                $periodo = $fila['Periodo'];
            ?>
                <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $codigoEmpleado; ?></td>
                    <td><?php echo $nombre; ?></td>
                    <td><?php echo $sexo; ?></td>
                    <td><?php echo $departamento; ?></td>
                    <td><?php echo $talla; ?></td>
                    <td><?php echo $cantCamisasBotones; ?></td>
                    <td><?php echo $cantCamisasPolo; ?></td>
                    <td><?php echo $cantCamisasOtros; ?></td>
                    <td><?php echo date_format($fechaEntrega, "Y-m-d"); ?></td>
                    <td><?php echo $periodo; ?></td>
                    <td>
                        <button class="btn im-btn-war btn-xs" onclick="editar(<?php echo $id ?>)"><span class="mdi mdi-account-edit"></span></button>
                        <button class="btn im-btn-nok btn-xs" onclick="eliminar(<?php echo $id ?>)"><span class="mdi mdi-delete"></span></button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <script>
        $('#tablaUniformes').DataTable({
            pageLength: 20,
            order: [
                [0, "desc"]
            ],
            lengthMenu: [
                [20, 40, 60, -1],
                [20, 40, 60, "Todo"]
            ],
            searching: true,
            // dom:'<"top"Blf>rt<"button"ip><"clear">',
            dom: "B<'row'<'col-sm-6 ' l><'col-sm-6 'f>><tr><'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [{
                extend: 'excel',
                text: 'Excel <i class="fas fa-file-excel" style="color:green;"></i>'
            }, {
                extend: 'copy',
                text: 'Copiar <i class="fas fa-copy"></i>',
            }, {
                extend: 'pdf',
                text: 'PDF <i class="fas fa-file-pdf" style="color:red;"></i>',

            }, {
                text: 'Agregar Uniforme <i class="fas fa-plus"></i>',
                className: 'button-agregar-lot mybtn class-disabled',
                action: function() {
                    agregar_uniforme();
                }
            }],
            language: {
                info: "Mostrando _START_ a _END_ de _TOTAL_ resultados",
                infoEmpty: "Mostrando 0 a 0 de 0 resultados",
                infoFiltered: "(filtrado de _MAX_ resultados)",
                infoPostFix: "",
                thousands: ",",
                lengthMenu: "Mostrar _MENU_",
                search: "Buscar:",
                zeroRecords: "Sin resultados",
                paginate: {
                    first: "Primera",
                    last: "Ultima",
                    next: "Siguiente",
                    previous: "Anterior"
                },
                buttons: {
                    copyTitle: 'Copiado en el Portapapeles',
                    copySuccess: {
                        _: '%d lineas copiadas',
                        1: '1 linea copiada'
                    }
                }
            },
            fixedHeader: {
                header: true,
                headerOffset: 0,
            },
            className: 'font-label',
        });
    </script>

<!-- <script>
        $('#tablaUniformes').DataTable({
            pageLength: 20,
            order: [
                [0, "desc"]
            ],
            lengthMenu: [
                [20, 40, 60, -1],
                [20, 40, 60, "Todo"]
            ],
            searching: true,
            // dom:'<"top"Blf>rt<"button"ip><"clear">',
            dom: "B<'row'<'col-sm-6 ' l><'col-sm-6 'f>><tr><'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [{
                extend: 'excel',
                text: 'Excel <i class="fas fa-file-excel" style="color:green;"></i>'
            }, {
                extend: 'copy',
                text: 'Copiar <i class="fas fa-copy"></i>',
            }, {
                extend: 'pdf',
                text: 'PDF <i class="fas fa-file-pdf" style="color:red;"></i>',

            }, {
                text: 'Agregar Cambio <i class="fas fa-plus"></i>',
                className: 'button-agregar-lot mybtn class-disabled',
                action: function() {
                    agregar_gestion();
                }
            }],
            language: {
                info: "Mostrando _START_ a _END_ de _TOTAL_ resultados",
                infoEmpty: "Mostrando 0 a 0 de 0 resultados",
                infoFiltered: "(filtrado de _MAX_ resultados)",
                infoPostFix: "",
                thousands: ",",
                lengthMenu: "Mostrar _MENU_",
                search: "Buscar:",
                zeroRecords: "Sin resultados",
                paginate: {
                    first: "Primera",
                    last: "Ultima",
                    next: "Siguiente",
                    previous: "Anterior"
                },
                buttons: {
                    copyTitle: 'Copiado en el Portapapeles',
                    copySuccess: {
                        _: '%d lineas copiadas',
                        1: '1 linea copiada'
                    }
                }
            },
            fixedHeader: {
                header: true,
                headerOffset: 0,
            },
            className: 'font-label',

        });
    </script> -->


<?php
}
?>