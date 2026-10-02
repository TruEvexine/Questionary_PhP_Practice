<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resultado - Questionary</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<?php include_once 'header.php'; ?>
<div class="aura-bg">
    <div class="aura-layer-1" aria-hidden="true"></div>
    <div class="aura-layer-2" aria-hidden="true"></div>
    <div class="aura-layer-3" aria-hidden="true"></div>
    
    <div style="position: relative; z-index: 1;">
        <section class="titlePage">
            <h1>Resultado</h1>
        </section>

        <main class="container">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = trim((string)($_POST["name"] ?? ""));
                $materia = trim((string)($_POST["materia"] ?? ""));
                $calificacion = filter_var($_POST["calificacion"] ?? "", FILTER_VALIDATE_FLOAT);

                if ($name === "" ||
                    $materia === "" ||
                    $calificacion === false ||
                    $calificacion < 0 ||
                    $calificacion > 10
                ) {
                    echo "<p style='color: #f87171;'>Ingresa todos los datos y una calificacion entre 0 y 10</p>";
                } else {
                    echo "<h2 style='margin-bottom: 20px; color: #22d3ee;'>Datos registrados</h2>";
                    echo "<p style='font-size: 1.1rem; margin: 8px 0;'><strong>Nombre:</strong> " . htmlspecialchars($name, ENT_QUOTES, "UTF-8") . "</p>";
                    echo "<p style='font-size: 1.1rem; margin: 8px 0;'><strong>Materia:</strong> " . htmlspecialchars($materia, ENT_QUOTES, "UTF-8") . "</p>";
                    echo "<p style='font-size: 1.1rem; margin: 8px 0;'><strong>Calificación:</strong> " . $calificacion . "</p>";
                }
            }
            ?>
            <br>
            <a href="index.php" style="color: #22d3ee; text-decoration: none; font-weight: 600; display: inline-block; margin-top: 15px;">&larr; Volver</a>
        </main>
    </div>
</div>
<?php include_once 'footer.php'; ?>
</body>
</html>
