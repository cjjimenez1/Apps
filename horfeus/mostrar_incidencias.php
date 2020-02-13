<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <h2><p>Esta página muestra una tabla con todas las incidencias</p></h2>
        
            
        
        <?php
        require ('datos_conexion.php');//Uso los datos de conexcion que están en el fichero conexion.php
        $conexion= mysqli_connect($db_host, $db_usuario, $db_clave);
        if (mysqli_connect_errno()){
            echo "No se ha podido conectar con la BD";
            exit();
        }
        mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la BD");
        mysqli_set_charset($conexion, "utf8");
        $consulta="Select * from horfeus order by Id";
        $resultado= mysqli_query($conexion, $consulta);
        echo "<table border=1>";
        echo "<tr><th bgcolor='#BDC3C7'>Id</th>";
        echo "<th bgcolor='#BDC3C7'>Texto de apertura</th>";
        echo "<th bgcolor='#BDC3C7'>Resumen</th>";
        echo "<th bgcolor='#BDC3C7'>Texto de cierre</th>";
        echo "<th bgcolor='#BDC3C7'>Fecha</th>";
        while($fila= mysqli_fetch_array($resultado,MYSQLI_ASSOC)){
            echo "<tr><td style='padding-left:10px;padding-right:10px'>";
            echo $fila['Id'] . "</td><td style='padding-left:10px;padding-right:10px; width: 37%'>";
            echo $fila['Texto_apertura'] . "</td><td style='padding-left:10px;padding-right:10px'> ";
            echo $fila['Resumen_cierre'] . "</td><td style='padding-left:10px;padding-right:10px; width: 37%'> ";
            echo $fila['Texto_cierre'] . "</td><td style='padding-left:10px;padding-right:10px'>";
            echo $fila['Fecha'] . "</td></tr>";
         }
        echo"</table>";
        
        // Hasta aquí muestra una tabla con los registros que hay en la tabla alumnos
        ?>
        <p><input type="button" onclick="location.href='http://localhost/Pruebas_PHP/horfeus'" name="boton_atras" value="Volver a página principal"></p>
    </body>
</html>
