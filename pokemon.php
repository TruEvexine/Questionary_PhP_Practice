<?php

$pokemon = isset($_GET["pokemon"]) ? $_GET["pokemon"] : "";
$datos = null;

if (!empty($pokemon)) {
    $url = "https://pokeapi.co/api/v2/pokemon/" . strtolower($pokemon);

    $respuesta = @file_get_contents($url);
    if ($respuesta) {
        $datos = json_decode($respuesta, true);
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pokemon <?php echo htmlspecialchars($pokemon); ?></title>
    <link rel="stylesheet" href="pokemon.css">
</head>
<body>
<?php include_once 'header.php'; ?>
<section class="titlePOke">
    <h1>Pokemon Finder</h1>
</section>

<section class="pokemonQuery">
    <form action="pokemon.php" method="get">
        <input type="text" name="pokemon" placeholder="Enter a Pokemon name" value="<?php echo htmlspecialchars($pokemon); ?>">
        <button type="submit">Search</button>
    </form>
</section>
<hr>


<?php if ($datos): ?>
    <div class="imagePoke">
        <img src="<?php echo $datos['sprites']['front_default']; ?>" alt="<?php echo htmlspecialchars($pokemon); ?>">
        <img src="<?php echo $datos['sprites']['front_shiny']; ?>" alt="<?php echo htmlspecialchars($pokemon); ?>">
    </div>
    <div class="pokemon-info">
        <h2><?php echo htmlspecialchars($pokemon); ?></h2>
        <p>Type: <?php echo implode(', ', array_map(function($type) { return $type['type']['name']; }, $datos['types'])); ?></p>
        <p>Height: <?php echo $datos['height']/10; ?> m</p>
        <p>Weight: <?php echo $datos['weight']/10; ?> kg</p>
        <p>Ability: <?php echo implode(', ', array_map(function($ability) { return $ability['ability']['name']; }, $datos['abilities'])); ?></p>
        <p>HP: <?php echo $datos['stats'][0]['base_stat']; ?></p>
    </div>
<?php elseif (!empty($pokemon)): ?>
    <p style="text-align: center; color: red;">Pokémon not found. Try another one!</p>
<?php endif; ?>

<hr>

<div class="hidden-pokemon">
    <p>Select a Pokemon manually</p>

    <button onclick="togglePokemon()" id="btnPokemon">Show all Pokémon</button>


    <div id="contenedorPokemon" style="display: none; margin-top: 15px;">
        <?php include 'pkFunctions.php'; ?>
    </div>
</div>


<?php include_once 'footer.php'; ?>






<script>
    function togglePokemon() {

        const contenedor = document.getElementById("contenedorPokemon");
        const boton = document.getElementById("btnPokemon");

        if (contenedor.style.display === "none") {
            contenedor.style.display = "block";
            boton.innerText = "Hide Pokemon";
        } else {
            contenedor.style.display = "none";
            boton.innerText = "Show all Pokémon";
        }
    }
</script>
</body>
</html>
