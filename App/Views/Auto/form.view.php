<?php

/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Auto $auto */
/** @var string $povodnaSpz ŠPZ pred úpravou ('' pri novom vozidle) */
/** @var string|null $chyba chybová hláška */
/** @var array|null $zakazka údaje rozpracovanej zákazky (ak auto pridávame z formulára zákazky) */
/** @var string $zrusitUrl kam vedie tlačidlo Zrušiť */

$jeNove = $povodnaSpz === '';
?>

<main class="form-main">
    <section class="table-section">
        <h2 class="form-title"><?= $jeNove ? 'Pridanie nového vozidla' : 'Úprava vozidla ' . e($povodnaSpz) ?></h2>

        <?php if ($zakazka !== null): ?>
            <p class="form-info">Po uložení sa vrátite k zákazke a vozidlo v nej bude vybrané.</p>
        <?php endif; ?>

        <?php if ($chyba !== null): ?>
            <p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> <?= e($chyba) ?></p>
        <?php endif; ?>

        <form method="post" action="<?= $link->url('auto.save') ?>" class="zakazka-form">
            <?php if (!$jeNove): ?>
                <input type="hidden" name="povodnaSpz" value="<?= e($povodnaSpz) ?>">
            <?php endif; ?>

            <?php if ($zakazka !== null): ?>
                <?php foreach ($zakazka as $nazov => $hodnota): ?>
                    <input type="hidden" name="zakazka[<?= e($nazov) ?>]" value="<?= e($hodnota) ?>">
                <?php endforeach; ?>
            <?php endif; ?>

            <div class="form-grid">
                <div class="form-group">
                    <label for="spz">ŠPZ</label>
                    <input type="text" id="spz" name="spz" maxlength="20" required
                           placeholder="napr. ZA123AB" value="<?= e($auto->getSpz()) ?>">
                </div>
                <div class="form-group">
                    <label for="vozidlo">Vozidlo (značka a model)</label>
                    <input type="text" id="vozidlo" name="vozidlo" maxlength="100" required
                           placeholder="napr. Audi A4" value="<?= e($auto->getVozidlo()) ?>">
                </div>
                <div class="form-group">
                    <label for="rok">Rok výroby</label>
                    <input type="number" id="rok" name="rok" min="1900" max="2100"
                           placeholder="napr. 2015" value="<?= e($auto->getRok()) ?>">
                </div>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-apply">Uložiť</button>
                <a href="<?= e($zrusitUrl) ?>" class="btn-apply btn-link">Zrušiť</a>
            </div>
        </form>
    </section>
</main>