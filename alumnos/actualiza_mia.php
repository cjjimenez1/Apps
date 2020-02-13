<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h3><p>Esta página muestra la tabla alumnos para poder modificarla con un UPDATE</p></h3>
        <?php
        
        require ('datos_conexion.php');//Uso los datos de conexcion que están en el fichero conexion.php
        $conexion= mysqli_connect($db_host, $db_usuario, $db_clave);
        if (mysqli_connect_errno()){
            echo "No se ha podido conectar con la BD";
            exit();
        }
        mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la BD");
        mysqli_set_charset($conexion, "utf8");
        $consulta="Select * from alumnos order by Id";//consulta que muestra todo el contenido de la tabla
        $resultado= mysqli_query($conexion, $consulta);
        echo "<table border=1>";
        echo "<tr><th bgcolor='#BDC3C7'>Id</th>";
        echo "<th bgcolor='#BDC3C7'>Nombre</th>";
        echo "<th bgcolor='#BDC3C7'>Ciudad</th>";
        echo "<th bgcolor='#BDC3C7'>Asignatura</th>";
        echo "<th bgcolor='#BDC3C7'>Nota</th></tr>";
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
        ?>
        <form method="get" name="form">
        <p><input type="submit"name="renumerar" value="Reordenar Id´s"></p>
        <?php
        if (isset($_GET["renumerar"])){
            //echo "probando";
            $consulta="Select * from alumnos order by Id";//consulta que muestra todo el contenido de la tabla
            $resultado= mysqli_query($conexion, $consulta);
            $contador=1;
            while($fila= mysqli_fetch_array($resultado,MYSQLI_ASSOC)){
                //echo $fila['Id'] . " ";
                //echo $contador . " ";
                
                if ($fila['Id']<>$contador){
                    $sql_renumera="update alumnos set Id='$contador' where Id={$fila['Id']}";
                    $result_renumera= mysqli_query($conexion, $sql_renumera);
                    if ($result_renumera==FALSE){
                        echo "Error en la renumeración";
                    }else{
                    echo "Se han reenumerado los Id's";
                    }
                }
                $contador++;
            }
        }
        ?>
        <p>Selecciona el Id del alumno que quieres modificar</p>
        <select name="combo_id">
        <?php
        $sql="select * from alumnos order by Id";
        $result_nombre= mysqli_query($conexion, $sql);
        while($fila= mysqli_fetch_array($result_nombre,MYSQLI_ASSOC)){
            echo '<option value="'.$fila[Id].'">'.$fila[Id].'</option>';//Rellena el combo con los nombres de los alumnos
        }
        ?>
        </select>
        <input type="submit" style="background-color:#77FF33" name="ok" value="Enviar">
        <input type="submit" name="cancel" value="Buscar otro">
        <input type="button" onclick="location.href='http://localhost/Pruebas_PHP/BBDD1/mi_pag.php'" name="boton_atras" value="Volver a página principal">
        <?php
        if (isset($_GET["ok"])){
            $seleccionado=$_GET["combo_id"];
            echo "<p>El Id del alumno es $seleccionado";
            echo "<p>Introduce los nuevos datos del alumno seleccionado:</p>";
            echo "<table border='1'>";
            $sql_buscar="select * from alumnos where Id like '$seleccionado'";
            $result_buscar= mysqli_query($conexion, $sql_buscar);
            while ($fila_busc= mysqli_fetch_array($result_buscar,MYSQLI_ASSOC)){//Muestro una tabla con los datos del alumno seleccionado para editarla
                echo "<tr><th bgcolor='#BDC3C7'>Campo</th><th bgcolor='#BDC3C7'>Valor</th></tr>";//Se le puede poner colores en hexadecimal. En RGB no lo pilla bien
                echo "<tr><td bgcolor='#87CEEB'>Id</td><td><input type='text' name='id' readonly value='{$fila_busc['Id']}'></td></tr>";
                echo "<tr><td bgcolor='#87CEEB'>Nombre</td><td><input type='text' name='nombre' value='{$fila_busc['Nombre']}'></td></tr>";
                echo "<tr><td bgcolor='#87CEEB'>Ciudad</td><td>";
                echo "<select name='combo_ciudad'>";
                $sql="select * from ciudades";
                $result_nombre= mysqli_query($conexion, $sql);
                while($fila= mysqli_fetch_row($result_nombre)){
                    echo '<option value="'.$fila[1].'">'.$fila[1].'</option>';//Rellena el combo con los nombres de las ciudades
                }
                echo "</select></td></tr>";
                echo "<tr><td bgcolor='#87CEEB'>Asignatura</td><td><input type='text' name='asignatura' value='{$fila_busc['Asignatura']}'></td></tr>";
                echo "<tr><td bgcolor='#87CEEB'>Nota</td><td><input type='number' name='nota' min='0' max='10' value='{$fila_busc['Nota']}'></td></tr>";
            }
            echo"</table>";
            echo '<br><input type="reset" name="otro" value="Cancelar">';
            echo '&nbsp<input type="submit" name="actualizar" style="background-color:#77FF33" value="Actualizar">';
        }    
        if (isset($_GET['actualizar'])){
            $id=$_GET['id'];
            $nombre=$_GET['nombre'];
            $ciudad=$_GET['combo_ciudad'];
            $asignatura=$_GET['asignatura'];
            $nota=$_GET['nota'];
            $sql_actualizar="update alumnos set Nombre='$nombre', Ciudad='$ciudad', Asignatura='$asignatura', Nota='$nota' where Id='$id'";
            $result_actualizar= mysqli_query($conexion, $sql_actualizar);
            if ($result_actualizar==FALSE){
                echo 'Error en la consulta';
            }else{
                echo "<br><br>Registro actualizado<br><br>";
                echo "<table border='1' style='border-collapse: collapse' cellpadding=7px>";
                echo "<tr><th bgcolor='#BDC3C7' colspan='5'>Estos son los nuevos datos</th></tr>";
                echo "<tr><td>$id</td><td>$nombre</td><td>$ciudad</td><td>$asignatura</td><td>$nota</td></tr>";
                echo "</table>";
            }
        }
        ?>
        </form>
    </body>
</html>
