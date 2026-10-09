<?php
include_once 'connection.php';
$message = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
 $id= (int) trim($_POST['id']);
 $name = trim($_POST['nombre']);
 $email = trim($_POST['email']);
 $password = $_POST['password'];


 //Hash the password
 $password = password_hash($password, PASSWORD_DEFAULT);

 //create token
 $token = bin2hex(random_bytes(32));

 $sql = "INSERT INTO usuarios (id, nombre, email, password, token_verified) VALUES (?, ?, ?, ?, ?) ";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("issss", $id, $name, $email, $password, $token);

    if($stmt->execute()) {
        $message = "User registered successfully";
        echo "<p>
To verify your account, please click on the link below: <a href='verify.php?token=$token'>Verify Account</a></p>";
    } else {
        $message = "Error: " . $stmt->error;
    }

}

?>

<link rel="stylesheet" href="dashboard_register.css">
<?php include_once 'header.php'?>
<div class="aura-bg">
    <div class="aura-layer-1"></div>
    <div class="aura-layer-2"></div>
    <div class="aura-layer-3"></div>
    <div>
        <div class="titlePage">
            <h1>Register</h1>
        </div>
        <div class="register-container">
            <?php if($message): ?>
                <div class="message"><?php echo $message; ?></div>
            <?php endif; ?>
            <form method="POST">
                <label>Control Number</label>
                <input type="number" name = "id" min="1" required>
                <label>Name</label>
                <input type="text" name = "nombre" required>
                <label>Email</label>
                <input type="email" name = "email" required>
                <label>Password</label>
                <input type="password" name = "password" required>
                <button type="submit">Create Account</button>
            </form>
        </div>
    </div>
</div>
<?php include_once 'footer.php'?>