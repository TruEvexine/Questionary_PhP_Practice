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
        echo "<p>Ingresa todos los datos y una calificacion entre 0 y 10</p>";
    } else {
        echo "<h2>Datos registrados</h2>";
        echo "<p>Nombre: " . htmlspecialchars($name, ENT_QUOTES, "UTF-8") . "</p>";
        echo "<p>Materia: " . htmlspecialchars($materia, ENT_QUOTES, "UTF-8") . "</p>";
        echo "<p>Calificación: " .$calificacion. "</p>";
    }
}
?>