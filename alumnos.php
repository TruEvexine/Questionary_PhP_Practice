<?php
include_once 'connection.php';
$sql = "SELECT * FROM alumnos";

$resultado = $conexion->query($sql);


?>

<h1>Califications List</h1>
<table border="1">
    <tr>
        <th>Id</th>
        <th>Id_Student</th>
        <th>Name</th>
        <th>Carrer</th>
        <th>Email</th>

    </tr>
<br>
    <?php while ($fila=$resultado->fetch_assoc()){?>
        <tr>
            <td><?php echo $fila['id'];?></td>
            <td><?php echo $fila['matricula'];?></td>
            <td><?php echo htmlspecialchars($fila['nombre']);?></td>
            <td><?php echo htmlspecialchars($fila['carrera']);?></td>
            <td><?php echo $fila['correo'];?></td>

        </tr>
        <?php
    }?>
</table>


