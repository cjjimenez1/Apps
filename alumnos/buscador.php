<html>
    <head>
        <meta charset="UTF-8">
        <title>Buscador de alumnos</title>
    </head>
    <style>
        .rojo{
            color:#FF0000
        }
    </style>
    <body>
        <form method="get" name="form">
            <p>Introduzca nombre del alumno a buscar: <input type="text" name="nombre"></p>
            <p><input type="submit" name="boton_buscar" value="Buscar"</p>
            
        </form>
        <?php
        if (isset($_GET['boton_buscar'])){
            $busqueda=$_GET['nombre'];//Guardo en $busqueda lo que el usuario pone en el cuadro de texto
            if($busqueda==""){
                echo "<p class='rojo'>Debe introducir un nombre</p>";
            }else{
                require ('datos_conexion.php');//Uso los datos de conexcion que están en el fichero conexion.php
                $conexion= mysqli_connect($db_host, $db_usuario, $db_clave);
                if (mysqli_connect_errno()){
                    echo "No se ha podido conectar con la BD";
                    exit();
                }
                mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la BD");
                mysqli_set_charset($conexion, "utf8");
                $consulta="Select * from alumnos where Nombre like '%$busqueda%'";//los caracteres % al principio y al final sirven de comodines. Busco nombre car y lo encuentra
                $resultado= mysqli_query($conexion, $consulta);
                if (mysqli_affected_rows($conexion)==0){//Si el número de filas que devuelve el select es 0
                    echo "No hay alumnos con el nombre de $busqueda";
                } else {
                    echo "<table border=1>";
                    echo "<tr><th bgcolor='#BDC3C7'>Id</th>";
                    echo "<th bgcolor='#BDC3C7'>Nombre</th>";
                    echo "<th bgcolor='#BDC3C7'>Ciudad</th>";
                    echo "<th bgcolor='#BDC3C7'>Asignatura</th>";
                    echo "<th bgcolor='#BDC3C7'>Nota</th>";
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
                }
            }
        }
        
        ?>
        <p><input type="button" onclick="location.href='http://localhost/Pruebas_PHP/BBDD1/mi_pag.php'" name="boton_atras" value="Volver a página principal"></p>
    </body>
</html>
