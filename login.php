<?php
session_start();
include_once 'connection.php';

$message = "";
if ($_SERVER["REQUEST_METHOD"]==="POST"){
 $email=trim($_POST['email']);
 $password=$_POST['password'];
 $sql="SELECT *FROM usuarios WHERE email=?";
 $stmt= $conexion->prepare($sql);
 $stmt->bind_param("s", $email);
 $stmt->execute();
 $result = $stmt->get_result();
 if($result->num_rows===1){
     $usuario = $result->fetch_assoc();
     if (!$usuario["email_verified"]){
         $message = "Please verify your email address";
     }
     elseif (
         password_verify($password, $usuario["password"])
     ){
        session_regenerate_id(true);
        $_SESSION["user_id"] = $usuario["id"];
        $_SESSION["nombre"] = $usuario["nombre"];
        header("Location: dashboard.php");
        exit;
     }
     else{
         $message = "Invalid password";
     }






 }

 else{
     $message = "Invalid user";
 }

}


?>

<link rel="stylesheet" href="login.css">
<?php include_once 'header.php'?>
<div class="aura-bg">
    <div class="aura-layer-1"></div>
    <div class="aura-layer-2"></div>
    <div class="aura-layer-3"></div>
    <div>
        <div class="titlePage">
            <h1>Login</h1>
        </div>
        <div class="login-container">
            <form method="POST">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                <button type="submit">Login</button>
            </form>
            <?php if($message): ?>
                <p><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>
            <a href="dashboard_register.php">Create an account</a>
        </div>
    </div>
</div>
<?php include_once 'footer.php'?>

