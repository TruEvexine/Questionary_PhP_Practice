<?php
$url = "https://pokeapi.co/api/v2/pokemon/?offset=0&limit=151";
$respuesta = file_get_contents($url);
$datos = json_decode($respuesta, true);

foreach ($datos["results"] as $pokemon) {
    $nombre = $pokemon['name'];


    $urlPartes = explode('/', trim($pokemon['url'], '/'));
    $id = end($urlPartes);


    $imagenUrl = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/{$id}.png";


    echo "<div style='display: flex; align-items: center; gap: 10px; margin-bottom: 10px;'>";
    echo "  <img src='{$imagenUrl}' alt='{$nombre}' width='80'>";
    echo "  <a href='pokemon.php?pokemon={$nombre}'>" . ucfirst($nombre) . "</a>";
    echo "</div>";
}
?>