<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <?php
        //$busqueda=$_POST['nombre'];//Guardo en $busqueda lo que el usuario pone en el cuadro de texto
        require ('datos_conexion.php');//Uso los datos de conexcion que están en el fichero conexion.php
        $conexion= mysqli_connect($db_host, $db_usuario, $db_clave);
        if (mysqli_connect_errno()){
            echo "No se ha podido conectar con la BD";
            exit();
        }
        mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la BD");
        mysqli_set_charset($conexion, "utf8");
        $consulta="Select * from alumnos order by Id";//los caracteres % al principio y al final sirven de comodines. Busco nombre car y lo encuentra
        $resultado= mysqli_query($conexion, $consulta);
        echo "<table border=1>";
        echo "<tr bgcolor='#BDC3C7'><th>Id</th>";
        echo "<th>Nombre</th>";
        echo "<th>Ciudad</th>";
        echo "<th>Asignatura</th>";
        echo "<th>Nota</th>";
        while($fila= mysqli_fetch_array($resultado,MYSQLI_ASSOC)){
            echo "<tr><td style='padding-left:10px;padding-right:10px'>";
            echo $fila['Id'] . "</td><td style='padding-left:10px;padding-right:10px'>";
            echo $fila['Nombre'] . "</td><td style='padding-left:10px;padding-right:10px'> ";
            echo $fila['Ciudad'] . "</td><td style='padding-left:10px;padding-right:10px'> ";
            echo $fila['Asignatura'] . "</td>";
            if (($fila['Nota'])<5){
                echo "<td style='color:#ff0000;padding-left:10px;padding-right:10px'>" . $fila['Nota'] . "</td></tr>";//Muestra en rojo los que tienen menos de 5
            }else{
                echo "<td style='padding-left:10px;padding-right:10px'>" . $fila['Nota'] . "</td></tr>";
            }
         }
        echo"</table>";
        
        // Hasta aquí muestra una tabla con los registros que hay en la tabla alumnos
        ?>
        <form method="get" name="form_borrar">
        <p>Selecciona el Id del alumno que quieres borrar</p>
        <select name="combo_id">
        <?php
        $sql="select * from alumnos order by Id";
        $result_nombre= mysqli_query($conexion, $sql);
        while($fila= mysqli_fetch_array($result_nombre,MYSQLI_ASSOC)){
            echo '<option value="'.$fila[Id].'">'.$fila[Id].'</option>';//Rellena el combo con los Id de los alumnos
        }
        ?>
        </select>
            <p><input type="submit" name="boton_borrar" value="Borrar">
            <input type="button" onclick="location.href='http://localhost/Pruebas_PHP/BBDD1/mi_pag.php'" name="boton_atras" value="Volver a página principal"></p>
        </form>
        
        <?php
        if (isset($_GET["boton_borrar"])){
            $cod_alumn=$_GET['combo_id'];
            $sql_borrar="delete from alumnos where Id = '$cod_alumn'";
            $result_borrar= mysqli_query($conexion, $sql_borrar);
            if ($result_borrar==FALSE){
                echo "Error en la consulta";
            }else{
                if (mysqli_affected_rows($conexion)==0){
                    //mysqli_affected_rows() devuelve el número de filas afectadas en la consulta. Si no hoy ninguna fila que borrar muestra el mensaje
                    echo "No hay registros que borrar";
                }else{
                    echo "Se ha borrado el alumno con código $cod_alumn";
                }
            }
        }
        ?>
    </body>
</html>
