<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <h2><p>Esta página muestra la tabla alumnos</p></h2>
        
            
        
        <?php
        require ('datos_conexion.php');//Uso los datos de conexcion que están en el fichero conexion.php
        $conexion= mysqli_connect($db_host, $db_usuario, $db_clave);
        if (mysqli_connect_errno()){
            echo "No se ha podido conectar con la BD";
            exit();
        }
        mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la BD");
        mysqli_set_charset($conexion, "utf8");
        $consulta="Select * from alumnos order by Id";
        $resultado= mysqli_query($conexion, $consulta);
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
        
        // Hasta aquí muestra una tabla con los registros que hay en la tabla alumnos
        ?>
        <p><input type="button" onclick="location.href='http://localhost/Pruebas_PHP/BBDD1/mi_pag.php'" name="boton_atras" value="Volver a página principal"></p>
    </body>
</html>
