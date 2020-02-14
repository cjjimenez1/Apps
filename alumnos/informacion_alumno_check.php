<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h3><p>Esta página muestra la tabla alumnos para poder modificarla con un UPDATE</p></h3>
        <form method="get" name="form">
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
        echo "<tr><th bgcolor='#BDC3C7'>Check</th>";
        echo "<th bgcolor='#BDC3C7'>Id</th>";
        echo "<th bgcolor='#BDC3C7'>Nombre</th>";
        echo "<th bgcolor='#BDC3C7'>Ciudad</th>";
        echo "<th bgcolor='#BDC3C7'>Asignatura</th>";
        echo "<th bgcolor='#BDC3C7'>Nota</th></tr>";
        while($fila= mysqli_fetch_array($resultado,MYSQLI_ASSOC)){
            echo "<tr><td style='padding-left:10px;padding-right:10px'>";
            echo "<input type='checkbox' name='check_list[]' value='{$fila['Id']}'></td><td style='padding-left:10px;padding-right:10px'>";
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
        
        <p><input type="submit"name="enviar" value="Buscar"></p>
        <?php
        if(isset($_GET['enviar'])){
            if(!empty($_GET['check_list'])) {
                // Counting number of checked checkboxes.
                $checked_count = count($_GET['check_list']);
                echo "Has seleccionado ".$checked_count." alumno(s): <br/>";
                // Loop to store and display values of individual checked checkbox.
                foreach($_GET['check_list'] as $selected) {
                    //echo "<p>".$selected ."</p>";
                    //echo "<p>Introduce los nuevos datos del alumno seleccionado:</p>";
                    echo "<table border='1'>";
                    $sql_buscar="select * from alumnos where Id like '$selected'";
                    $result_buscar= mysqli_query($conexion, $sql_buscar);
                    while ($fila_busc= mysqli_fetch_array($result_buscar,MYSQLI_ASSOC)){//Muestro una tabla con los datos de los alumnos seleccionados
                        echo "<p><tr><th width= '100px%' bgcolor='#BDC3C7'>Campo</th><th width= '100px%' bgcolor='#BDC3C7'>Valor</th></tr>";//Se le puede poner colores en hexadecimal. En RGB no lo pilla bien
                        echo "<tr><td bgcolor='#87CEEB'>Id</td><td style='padding-left:5px;padding-right:10px'>{$fila_busc['Id']}</td></tr>";
                        echo "<tr><td bgcolor='#87CEEB'>Nombre</td><td style='padding-left:5px;padding-right:10px'>{$fila_busc['Nombre']}</td></tr>";
                        echo "<tr><td bgcolor='#87CEEB'>Ciudad</td><td style='padding-left:5px;padding-right:10px'>{$fila_busc['Ciudad']}</td></tr>";
                        echo "<tr><td bgcolor='#87CEEB'>Asignatura</td><td style='padding-left:5px;padding-right:10px'>{$fila_busc['Asignatura']}</td></tr>";
                        echo "<tr><td bgcolor='#87CEEB'>Nota</td>";
                        if (($fila_busc['Nota'])<5){
                            echo "<td style='color:#ff0000;padding-left:5px;padding-right:10px'>" . $fila_busc['Nota'] . "</td></tr>";//Muestra en rojo los que tienen menos de 5
                        }else{
                            echo "<td style='padding-left:5px;padding-right:10px'>" . $fila_busc['Nota'] . "</td></tr>";
                        }
                                    //{$fila_busc['Nota']}</td></tr></p>";
                    }
                    echo"</table>";
                }
                //echo "<br/><b>Note :</b> <span>Similarily, You Can Also Perform CRUD Operations using These Selected Values.</span>";
            }
            else{
            echo "<b>Selecciona una opción.</b>";
            }
        }
        ?>

        </form>
    </body>
</html>
