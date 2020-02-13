<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    <h1 style="color: #4485b8;text-align: center">Página de pruebas para manipular (insertar, consultar, buscar, modificar y eliminar) datos de una tabla</h1>
    <br><br><br>
    <table border="1" style="border-collapse: collapse; width: 90%; margin-left: auto; margin-right: auto">
    <tbody>
    <tr>
    <td style="width: 100%; background-color: #ffbf80; text-align: center;" colspan="5">
        <h2><strong>Página de pruebas con PHP que ataca a una base de datos MySQL donde están los alumnos y las ciudades a las que pertenecen</strong></h2><br>
        <h3>Podemos insertar alumnos nuevos, mostrar la tabla alumnos, hacer búsquedas por el nombre, actualizar cualquier dato de un alumno y borrar un alumno</h3>
    </td>
    </tr>
    <tr>
        <td style="width: 20%;text-align: center"><form method="get" name="form_insertar" action="insertar_reg_form.php">
            <input type="submit" name="insertar" value="Insertar alumno" style="font-size: 20px; color:#CC6600; width: 90%; height: 100px; background-color: #FFFFB3">
        </form></td>
        <td style="width: 20%;text-align: center"><form method="get" name="form_mostar" action="mostrar_tabla_alumnos.php">
            <input type="submit" name="consultar" value="Consultar tabla alumnos" style="font-size: 20px; color:red; width: 90%; height: 100px; background-color: #FFB3FF">
        </form>
        </td>
        <td style="width: 20%;text-align: center"><form method="get" name="form_buscar" action="buscador.php">
            <input type="submit" name="buscar" value="Buscar alumno" style="font-size: 20px; color:#00F; width: 90%; height: 100px; background-color: #B3CCFF">
        </form>
        </td>
        <td style="width: 20%;text-align: center"><form method="get" name="form_actualizar" action="actualiza_mia.php">
                <input type="submit" name="actualizar_principal" value="Actualizar datos de un alumno" style="font-size: 20px; color:green; width: 90%; height: 100px; background-color: #BFFFB3">
        </form>
        </td>
        <td style="width: 20%;text-align: center"><form method="get" name="form_eliminar" action="borrar_registro.php">
            <input type="submit" name="borrar" value="Borrar alumno" style="font-size: 20px; color:#FF0000; width: 90%; height: 100px; background-color: #FFCCCC">
        </form>
        </td>
    </tr>
    </tbody>
    </table>
        <?php
        // put your code here
        ?>
    </body>
</html>
