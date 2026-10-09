<?php
session_start();
include_once 'connection.php';
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$sql = "SELECT materias.nombre as materia, calificacion.calif FROM calificacion INNER JOIN materias ON calificacion.materia_id = materias.id WHERE calificacion.user_id=?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$calificaciones = $stmt->get_result();
?>

<link rel="stylesheet" href="dashboard.css">
<?php include_once 'header.php'?>
<div class="aura-bg">
    <div class="aura-layer-1"></div>
    <div class="aura-layer-2"></div>
    <div class="aura-layer-3"></div>
    <div>
        <div class="titlePage">
            <h1>Welcome <?php echo htmlspecialchars($user['nombre']); ?></h1>
        </div>
        <div class="dashboard-container">
            <h2>My Data</h2>
            <p><strong>ID:</strong> <?php echo htmlspecialchars($user['id']); ?></p>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($user['nombre']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <hr>
            <h2>My Grades</h2>
            <table border="1">
                <tr>
                    <th>Subject</th>
                    <th>Calification</th>
                </tr>
                <?php
                while ($fila = $calificaciones->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($fila['materia']); ?></td>
                    <td><?php echo htmlspecialchars($fila['calif']); ?></td>
                </tr>
                <?php
                }?>
            </table>
            <hr>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</div>
<?php include_once 'footer.php'?>