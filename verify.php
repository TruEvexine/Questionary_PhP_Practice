<?php
include_once 'connection.php';
$token = $_GET['token']??"";
$sql = "SELECT id FROM usuarios WHERE token_verified = ?";
$stmt=$conexion->prepare($sql);
$stmt->bind_param("s", $token);
$stmt->execute();
$resultado = $stmt->get_result();
$verification_message = "";
if ($resultado->num_rows===1){
    $usuario = $resultado->fetch_assoc();
$sql = "UPDATE usuarios SET email_verified = 1, token_verified = NULL WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuario['id']);
$stmt->execute();
$verification_message = "Account verified successfully";
} else {
    $verification_message = "Invalid token";
}
?>

<link rel="stylesheet" href="verify.css">
<?php include_once 'header.php'?>
<div class="aura-bg">
    <div class="aura-layer-1"></div>
    <div class="aura-layer-2"></div>
    <div class="aura-layer-3"></div>
    <div>
        <div class="titlePage">
            <h1>Verification</h1>
        </div>
        <div class="verify-container">
            <p><?php echo htmlspecialchars($verification_message); ?></p>
            <a href="login.php">Start Session</a>
        </div>
    </div>
</div>
<?php include_once 'footer.php'?>