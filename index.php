<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Questionary</title>
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
            <h1>Questionary</h1>
        </section>

        <main class="container">
            <form action="resultado.php" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <br><br>
                <label for="materia">Subject:</label>
                <input type="text" id="materia" name="materia" required>
                <br><br>
                <label for="calificacion">Calification:</label>
                <input type="number" id="calificacion" name="calificacion" step="any" required>
                <br><br>
                <input type="submit" value="Enviar">

            </form>
        </main>
    </div>
</div>





    <?php include_once 'footer.php'; ?>

</body>
</html>
