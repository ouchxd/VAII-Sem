<?php

/** @var \Framework\Support\LinkGenerator $link */
?>

<div class="obsah-container">
    <!-- Uvítacia sekcia -->
    <section class="hero-sekcia">
        <div class="hero-text">
            <h1>Vitajte v našom Autoservise</h1>
            <p>Postaráme sa o vaše auto rýchlo, spoľahlivo a za férové ceny. Sme tu pre vás už viac ako 10 rokov a vašu bezpečnosť berieme vážne.</p>
            <a href="<?= $link->url('home.contact') ?>" class="btn-hlavne">Dohodnúť termín</a>
        </div>
    </section>

    <!-- Sekcia služieb -->
    <section class="sluzby-sekcia">
        <h2 class="sekcia-nadpis">Naše hlavné služby</h2>

        <div class="sluzby-grid">
            <!-- Karta 1 -->
            <div class="sluzba-karta">
                <i class="fa-solid fa-car-burst ikona-sluzby"></i>
                <h3>Pneuservis</h3>
                <p>Prezutie, vyváženie a oprava defektov na počkanie. Ponúkame aj sezónne uskladnenie pneumatík.</p>
            </div>

            <!-- Karta 2 -->
            <div class="sluzba-karta">
                <i class="fa-solid fa-oil-can ikona-sluzby"></i>
                <h3>Výmena oleja</h3>
                <p>Používame len certifikované oleje a kvalitné filtre pre zabezpečenie dlhej životnosti vášho motora.</p>
            </div>

            <!-- Karta 3 (pridaná pre ukážku, aby bol grid plnší) -->
            <div class="sluzba-karta">
                <i class="fa-solid fa-wrench ikona-sluzby"></i>
                <h3>Autodiagnostika</h3>
                <p>Rýchla a presná diagnostika porúch pomocou najmodernejších prístrojov pre všetky značky áut.</p>
            </div>
        </div>
    </section>
</div>
