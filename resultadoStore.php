<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $client = trim((string)($_GET["client"] ?? ""));
    $product = trim((string)($_GET["product"] ?? ""));
    $price = filter_var($_GET["price"] ?? "", FILTER_VALIDATE_FLOAT);
    $quantity = filter_var($_GET["quantity"] ?? "", FILTER_VALIDATE_INT);
    if ($client === "" ||
        $product === "" ||
        $price === false ||
        $quantity === false ||
        $quantity < 1 ||
        $quantity > 99
    ) {
        echo "<p>Ingresa todos los datos requeridos y una cantidad entre 1 y 99</p>";
    } else {
        echo "<h2>Datos registrados</h2>";
        echo "<p>Nombre del cliente: " . htmlspecialchars($client, ENT_QUOTES, "UTF-8") . "</p>";
        echo "<p>Producto: " . htmlspecialchars($product, ENT_QUOTES, "UTF-8") . "</p>";
        echo "<p>Precio unitario: " . htmlspecialchars($price, ENT_QUOTES, "UTF-8") . "</p>";
        echo "<p>Cantidad: " . $quantity . "</p>";
        $subtotal = $price * $quantity;
        if ($subtotal > 500) {
            $discount = $subtotal * 0.10;
            echo "<p>Subtotal: " . htmlspecialchars($subtotal, ENT_QUOTES, "UTF-8") . "</p>";
            echo "<p>Descuento: " . htmlspecialchars($discount, ENT_QUOTES, "UTF-8") . "</p>";
            $total = $subtotal - $discount;
            echo "<p>Total: " . htmlspecialchars($total, ENT_QUOTES, "UTF-8") . "</p>";
            echo "<p>Gracias por su compra</p>";
        } else {
            echo "<p>El Total es: " . htmlspecialchars($subtotal, ENT_QUOTES, "UTF-8") . "</p>";
            echo "<p>Gracias por su compra</p>";
        }
    }
}
?>