<section class="filters">
    <div class="filtersConditions">
        <div class="filtersContainer">
            <h3>Filter par prix</h3>
            <p>
  <input type="text" id="amount" readonly="">
</p>
 
<div id="slider-range"></div>
        </div>
        <div class="filtersContainer">
            <h3>Filter par couleurs</h3>
            <div class="filtersColors">
            <button id="noir" class="filtersColorsItems"></button>
            <button id="blanc" class="filtersColorsItems"></button>
            <button id="rouge" class="filtersColorsItems"></button>
            <button id="jaune" class="filtersColorsItems"></button>
            <button id="vert" class="filtersColorsItems"></button>
            <button id="bleu" class="filtersColorsItems"></button>
            <button id="violet" class="filtersColorsItems"></button>
            <button id="gris" class="filtersColorsItems"></button>
        </div>
        <button id="filtersSup">❌ Supprimer le filtre</button>
        </div>
        <div class="filtersContainer">
            <h3>Filter par types</h3>
            <button id="roulettes">Roulettes</button>
            <button id="dossierInclinable">Dossier inclinable</button>
            <button id="tabouret">Tabouret</button>
            <button id="sansAccoudoires">Sans accoudoires</button>
        </div>
    </div>
    <div id="filtersProducts"></div>
</section>
<script src="./assets/js/filters.js" defer></script>