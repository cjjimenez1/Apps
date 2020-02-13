<html>
    <!--
Esta página pinta un formulario que se rellena para insertar esos datos en una BBDD
-->
    <head>
        <meta charset="UTF-8">
        <title>Formulario insertar registos en BBDD</title>
    </head>
    <body>
        <?php
        
        require ('datos_conexion.php');//Uso los datos de conexcion que están en el fichero conexion.php
        $conexion= mysqli_connect($db_host, $db_usuario, $db_clave);
        if (mysqli_connect_errno()){
            echo "No se ha podido conectar con la BD";
            exit();
        }
        mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la BD");
        mysqli_set_charset($conexion, "utf8");
        ?>
        <form method="get" name="form">
            <table border="1" style="border-collapse: collapse">
                <tr><th colspan="2" bgcolor='#BDC3C7'>Datos del alumno a insertar</th></tr>
                <tr><td>Introduzca Nombre: </td><td><input type="text" name="nombre"></td></tr>
                <tr><td>Introduzca Ciudad: </td><td>
                        <select name="combo_ciudad">
                            <?php
                            $sql="select * from ciudades";
                            $result_nombre= mysqli_query($conexion, $sql);
                            while($fila= mysqli_fetch_row($result_nombre)){
                                echo '<option value="'.$fila[1].'">'.$fila[1].'</option>';//Rellena el combo con los nombres de las ciudades. Da error con array asociativo
                            }
                            ?>
                        </select></td></tr>
                <tr><td>Introduzca Asignatura: </td><td><input type="text" name="asignatura"></td></tr>
                <tr><td>Introduzca Nota: </td><td><input type="number" name="nota" min="0" max="10"></td></tr>
            </table>
                <p><input type="submit" name="boton_insertar" value="Insertar">
                <input type="submit" name="boton_cancelar" value="Cancelar">
                <!--<input type="button" onclick="history.go(-2)" name="boton_atras" value="Volver atrás"> Esto es un botón que retrocede en el historial 2 veces pero me gusta más el del enlace-->
                <input type="button" onclick="location.href='http://localhost/Pruebas_PHP/BBDD1/mi_pag.php'" name="boton_atras" value="Volver a página principal"></p>
            
        </form>
        <?php
        if (isset($_GET['boton_insertar'])){
            $nombre=$_GET['nombre'];//Guardo en $nombre lo que el usuario pone en el cuadro de texto nombre
            $ciudad=$_GET['combo_ciudad'];//Guardo en $nombre lo que el usuario ha seleccionado en el combo ciudad
            $asignatura=$_GET['asignatura'];//Guardo en $nombre lo que el usuario pone en el cuadro de texto asignatura
            $nota=$_GET['nota'];//Guardo en $nota lo que el usuario pone en el cuadro de texto nota
            if ($nombre==""){
                echo "Debe introducir un nombre";
                exit();
            }else if ($asignatura==""){
                echo "Debe introducir una asignatura";
                exit();
            }else if ($nota==""){
                echo "Debe introducir una nota";
                exit();
            }
            require ('datos_conexion.php');//Uso los datos de conexcion que están en el fichero conexion.php
            $conexion= mysqli_connect($db_host, $db_usuario, $db_clave);
            if (mysqli_connect_errno()){
                echo "No se ha podido conectar con la BD";
                exit();
            }
            mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la BD");
            mysqli_set_charset($conexion, "utf8");
            $sql_id="SELECT MAX(Id)+1 FROM alumnos";//guardo en $sql_id el mayor número id y le sumo 1
            $resulset_id= mysqli_query($conexion, $sql_id);//ejecuto la sentencia
            $resultado_id= mysqli_fetch_row($resulset_id);//guardo el resultado de la sentencia en $resultado_id que es un array
            $sql="INSERT INTO alumnos (Id, Nombre, Ciudad, Asignatura, Nota) VALUES ('$resultado_id[0]', '$nombre','$ciudad','$asignatura','$nota')";
            /*Esto es otra forma de sacar el id. Primero hago el SELECT MAX(id)+1 y lo guardo en $SQL_id, ejecuto la consulta y la guardo en $resulset_id
             luego recorro el resulset y guardo el resultado en $resultado_id que es un array. Después inserto y muestro en la tabla la primera posición del array "$resultado_id[0]"*/
            $resultado= mysqli_query($conexion, $sql);
            if($resultado==FALSE){
                echo"Error en la consulta";
            }else{
                echo "Registro insertado<br><br>";
                echo "<table><tr><td>Id</td><td>$resultado_id[0]</td></tr>";
                echo "<tr><td>Nombre</td><td>$nombre</td></tr>";
                echo "<tr><td>Ciudad</td><td>$ciudad</td></tr>";
                echo "<tr><td>Asignatura</td><td>$asignatura</td></tr>";
                echo "<tr><td>Nota</td><td>$nota</td></tr></table>";

            }
        }
        // put your code here
        ?>
    </body>
</html>
