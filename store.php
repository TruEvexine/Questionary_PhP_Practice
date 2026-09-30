<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<div class="aura-bg">
    <div class="aura-layer-1" aria-hidden="true"></div>
    <div class="aura-layer-2" aria-hidden="true"></div>
    <div class="aura-layer-3" aria-hidden="true"></div>

    <div style="position: relative; z-index: 1;">
        <section class="titlePage">
            <h1>Ticket de Compra</h1>
        </section>

        <main class="container">
            <form action="resultadoStore.php" method="GET">
                <label for="client">Cliente:</label>
                <input type="text" id="name" name="client" required>
                <br><br>
                <label for="product">Producto:</label>
                <input type="text" id="product" name="product" required>
                <br><br>
                <label for="price">Precio Unitario:</label>
                <input type="number" id="price" name="price" step="any" required>
                <br><br>
                <label for="quantity">Cantidad:</label>
                <input type="number" id="quantity" name="quantity" required>
                <br><br>
                <input type="submit" value="Enviar">
            </form>
        </main>
    </div>
</div>





</body>
</html>
