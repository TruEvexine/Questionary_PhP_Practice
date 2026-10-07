<?php
include_once 'connection.php';
$sql = "SELECT * FROM calificaciones";

$resultado = $conexion->query($sql);


?>

<h1>Califications List</h1>
<table border="1">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Subject</th>
        <th>Calification</th>
    </tr>

    <?php while ($fila=$resultado->fetch_assoc()){?>
        <tr>
            <td><?php echo $fila['id'];?></td>
            <td><?php echo htmlspecialchars($fila['nombre']);?></td>
            <td><?php echo htmlspecialchars($fila['materia']);?></td>
            <td><?php echo $fila['calificacion'];?></td>
        </tr>
    <?php
}?>
 </table>

