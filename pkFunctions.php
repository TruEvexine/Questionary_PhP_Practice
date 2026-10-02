<?php
$url = "https://pokeapi.co/api/v2/pokemon/?offset=0&limit=151";
$respuesta = @file_get_contents($url);
$datos = $respuesta ? json_decode($respuesta, true) : null;

if ($datos && isset($datos["results"])) {
    echo "<div class='poke-catalog-controls'>";
    echo "  <input type='text' id='pokeCatalogFilter' placeholder='Search in catalog (e.g. Pikachu or 25)...' oninput='filterPokeCatalog()' autocomplete='off'>";
    echo "</div>";
    echo "<div class='poke-grid-container' id='pokeGridList'>";

    foreach ($datos["results"] as $pokemon) {
        $nombre = $pokemon['name'];
        $urlPartes = explode('/', trim($pokemon['url'], '/'));
        $id = end($urlPartes);
        $padId = str_pad($id, 3, '0', STR_PAD_LEFT);
        $imagenUrl = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/{$id}.png";

        echo "<a href='pokemon.php?pokemon={$nombre}' class='poke-card' data-name='" . strtolower($nombre) . "' data-id='{$id}'>";
        echo "  <span class='poke-card-number'>#{$padId}</span>";
        echo "  <div class='poke-card-img-wrap'>";
        echo "    <img src='{$imagenUrl}' alt='" . htmlspecialchars(ucfirst($nombre)) . "' loading='lazy'>";
        echo "  </div>";
        echo "  <span class='poke-card-name'>" . ucfirst($nombre) . "</span>";
        echo "</a>";
    }

    echo "</div>";
}
?>