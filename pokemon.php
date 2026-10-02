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
<div class="aura-bg">
  <div class="aura-layer-1" aria-hidden="true"></div>
  <div class="aura-layer-2" aria-hidden="true"></div>
  <div class="aura-layer-3" aria-hidden="true"></div>
  <div class="aura-grain" aria-hidden="true">
    <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
      <filter id="grain">
        <feTurbulence type="fractalNoise" baseFrequency="0.7" numOctaves="4" stitchTiles="stitch"/>
        <feColorMatrix type="matrix" values="0.181 0.608 0.061 0 0.075 0.181 0.608 0.061 0 0.075 0.181 0.608 0.061 0 0.075 0 0 0 1 0"/>
      </filter>
      <rect width="100%" height="100%" filter="url(#grain)"/>
    </svg>
  </div>
  <div style="position: relative; z-index: 1;">
<section class="titlePOke">
    <h1>Pokemon Search Engine</h1>
</section>

<section class="pokemonQuery">
    <form id="pokemonSearchForm" action="pokemon.php" method="get">
        <input type="text" id="pokemonInput" name="pokemon" placeholder="Enter a Pokemon name" value="<?php echo htmlspecialchars($pokemon); ?>">
        <button type="submit" id="searchBtn">Search</button>
    </form>
</section>

<div id="pokemonResultsArea">
    <div id="pokemonSkeleton" class="skeleton-container" style="<?php echo empty($pokemon) ? 'display: none;' : ''; ?>">
        <div class="name-poke">
            <div class="skeleton-box skeleton-title"></div>
            <div class="skeleton-types-group">
                <div class="skeleton-box skeleton-type-badge"></div>
                <div class="skeleton-box skeleton-type-badge"></div>
            </div>
        </div>

        <div class="skeleton-sprites-group">
            <div class="skeleton-box skeleton-sprite-card"></div>
            <div class="skeleton-box skeleton-sprite-card"></div>
        </div>
        <div class="skeleton-info">
            <div class="skeleton-box skeleton-info-card-placeholder"></div>
        </div>
    </div>

    <div id="pokemonContent" class="pokemon-content-wrapper <?php echo empty($pokemon) ? 'is-visible' : ''; ?>">
<?php if ($datos): ?>
        <div class="name-poke">
            <h2><?php echo htmlspecialchars(ucfirst($datos['name'])); ?></h2>
            <div class="poke-types-badge-list">
                <?php foreach ($datos['types'] as $t): ?>
                    <span class="poke-type-badge type-<?php echo htmlspecialchars($t['type']['name']); ?>">
                        <?php echo ucfirst(htmlspecialchars($t['type']['name'])); ?>
                    </span>
                <?php endforeach; ?>
            </div>
        </div>


    <div class="spritePoke">
        <div class="sprite-img-wrapper">
          <div class="sprite-img-bg"></div>
          <img src="<?php echo $datos['sprites']['front_default'] ?: ($datos['sprites']['other']['official-artwork']['front_default'] ?? ''); ?>" alt="<?php echo htmlspecialchars($pokemon); ?> - Normal">
          <p class="sprite-caption">Normal version</p>
        </div>
        <div class="sprite-img-wrapper">
          <div class="sprite-img-bg"></div>
          <img src="<?php echo $datos['sprites']['front_shiny'] ?: ($datos['sprites']['other']['official-artwork']['front_shiny'] ?? ''); ?>" alt="<?php echo htmlspecialchars($pokemon); ?> - Shiny">
          <p class="sprite-caption">Shining Version ✨</p>
        </div>
    </div>
    <div class="pokemon-info">
        <div class="poke-info-card">
            <h3 class="poke-info-section-title">About</h3>
            <div class="poke-metrics-grid">
                <div class="poke-metric-item">
                    <span class="metric-label">Height</span>
                    <span class="metric-value"><?php echo ($datos['height'] / 10); ?> m</span>
                </div>
                <div class="poke-metric-item">
                    <span class="metric-label">Weight</span>
                    <span class="metric-value"><?php echo ($datos['weight'] / 10); ?> kg</span>
                </div>
                <div class="poke-metric-item">
                    <span class="metric-label">Base XP</span>
                    <span class="metric-value"><?php echo isset($datos['base_experience']) ? $datos['base_experience'] . ' XP' : 'N/A'; ?></span>
                </div>
                <div class="poke-metric-item">
                    <span class="metric-label">Abilities</span>
                    <span class="metric-value"><?php echo implode(', ', array_map(function($a) { return ucfirst($a['ability']['name']); }, $datos['abilities'])); ?></span>
                </div>
            </div>

            <h3 class="poke-info-section-title" style="margin-top: 24px;">Base Stats</h3>
            <div class="poke-stats-list">
                <?php
                $statNames = [
                    'hp' => 'HP',
                    'attack' => 'Attack',
                    'defense' => 'Defense',
                    'special-attack' => 'Sp. Atk',
                    'special-defense' => 'Sp. Def',
                    'speed' => 'Speed'
                ];
                foreach ($datos['stats'] as $st):
                    $rawName = $st['stat']['name'];
                    $displayName = $statNames[$rawName] ?? ucfirst($rawName);
                    $val = (int)$st['base_stat'];
                    $pct = min(100, round(($val / 180) * 100));
                ?>
                <div class="poke-stat-row">
                    <span class="stat-name"><?php echo $displayName; ?></span>
                    <span class="stat-num"><?php echo $val; ?></span>
                    <div class="stat-bar-track">
                        <div class="stat-bar-fill stat-<?php echo $rawName; ?>" style="width: <?php echo $pct; ?>%;"></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

<?php elseif (!empty($pokemon)): ?>
    <p style="text-align: center; color: #ef4444; font-size: 1.2rem; margin: 30px 0;">Pokémon not found. Try another one!</p>
<?php endif; ?>
    </div>
</div>




<div class="hidden-pokemon">
    <p>Select a Pokemon manually</p>

    <button onclick="togglePokemon()" id="btnPokemon">Show all Pokemon</button>


    <div id="contenedorPokemon" style="display: none; margin-top: 15px;">
        <?php include 'pkFunctions.php'; ?>
    </div>
</div>


<?php include_once 'footer.php'; ?>
  </div>
</div>


<script>
    function filterPokeCatalog() {
        const input = document.getElementById("pokeCatalogFilter");
        if (!input) return;
        const filter = input.value.toLowerCase().trim();
        const cards = document.querySelectorAll("#pokeGridList .poke-card");
        
        cards.forEach(card => {
            const name = card.getAttribute("data-name") || "";
            const id = card.getAttribute("data-id") || "";
            if (name.includes(filter) || id.includes(filter)) {
                card.style.display = "flex";
            } else {
                card.style.display = "none";
            }
        });
    }

    function togglePokemon() {
        const contenedor = document.getElementById("contenedorPokemon");
        const boton = document.getElementById("btnPokemon");

        if (contenedor.style.display === "none") {
            contenedor.style.display = "block";
            boton.innerText = "Hide Pokemon";
        } else {
            contenedor.style.display = "none";
            boton.innerText = "Show all Pokemon";
        }
    }

    function showSkeleton() {
        const skeleton = document.getElementById("pokemonSkeleton");
        const content = document.getElementById("pokemonContent");
        if (skeleton && content) {
            skeleton.style.display = "flex";
            skeleton.classList.remove("is-hidden");
            content.classList.remove("is-visible");
        }
    }

    function hideSkeleton() {
        const skeleton = document.getElementById("pokemonSkeleton");
        const content = document.getElementById("pokemonContent");
        if (skeleton && content) {
            skeleton.classList.add("is-hidden");
            setTimeout(() => {
                skeleton.style.display = "none";
                content.classList.add("is-visible");
            }, 150);
        }
    }

    function preloadImages(container) {
        const images = container.querySelectorAll("img");
        const promises = Array.from(images).map(img => {
            if (img.complete) return Promise.resolve();
            return new Promise(resolve => {
                img.onload = resolve;
                img.onerror = resolve;
            });
        });
        return Promise.all(promises);
    }

    async function fetchPokemon(pokemonName, pushHistory = true) {
        const query = pokemonName.trim();
        if (!query) return;

        showSkeleton();

        try {
            const response = await fetch(`pokemon.php?pokemon=${encodeURIComponent(query)}`);
            const html = await response.text();

            const parser = new DOMParser();
            const doc = parser.parseFromString(html, "text/html");
            const newContent = doc.getElementById("pokemonContent");

            if (newContent) {
                const currentContent = document.getElementById("pokemonContent");
                if (currentContent) {
                    currentContent.innerHTML = newContent.innerHTML;
                    await preloadImages(currentContent);
                }
            }

            if (pushHistory) {
                history.pushState({ pokemon: query }, "", `pokemon.php?pokemon=${encodeURIComponent(query)}`);
            }
            document.title = `Pokemon ${query}`;

            const input = document.getElementById("pokemonInput");
            if (input) input.value = query;

            setTimeout(() => {
                hideSkeleton();
            }, 300);
        } catch (error) {
            console.error("Error loading pokemon:", error);
            hideSkeleton();
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        const input = document.getElementById("pokemonInput");
        const hasQuery = input && input.value.trim().length > 0;

        if (hasQuery) {
            showSkeleton();
            const content = document.getElementById("pokemonContent");
            if (content) {
                preloadImages(content).then(() => {
                    setTimeout(() => {
                        hideSkeleton();
                    }, 400);
                });
            } else {
                hideSkeleton();
            }
        }

        const form = document.getElementById("pokemonSearchForm");
        if (form) {
            form.addEventListener("submit", (e) => {
                e.preventDefault();
                const query = input ? input.value : "";
                fetchPokemon(query);
            });
        }

        const contenedor = document.getElementById("contenedorPokemon");
        if (contenedor) {
            contenedor.addEventListener("click", (e) => {
                const link = e.target.closest("a");
                if (link && link.href) {
                    const url = new URL(link.href, window.location.href);
                    const pokeParam = url.searchParams.get("pokemon");
                    if (pokeParam) {
                        e.preventDefault();
                        fetchPokemon(pokeParam);
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                }
            });
        }

        window.addEventListener("popstate", () => {
            const url = new URL(window.location.href);
            const poke = url.searchParams.get("pokemon") || "";
            if (poke) {
                fetchPokemon(poke, false);
            }
        });
    });
</script>
</body>
</html>
