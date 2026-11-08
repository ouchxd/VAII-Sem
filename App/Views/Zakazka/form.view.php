<?php

/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Zakazka $zakazka */

use App\Models\Zakazka;

$jeNova = $zakazka->getId() === null;
?>

<main class="form-main">
    <section class="table-section">
        <h2 class="form-title"><?= $jeNova ? 'Pridanie novej zákazky' : 'Úprava zákazky #' . e($zakazka->getId()) ?></h2>

        <form method="post" action="<?= $link->url('zakazka.save') ?>" class="zakazka-form">
            <?php if (!$jeNova): ?>
                <input type="hidden" name="id" value="<?= e($zakazka->getId()) ?>">
            <?php endif; ?>

            <div class="form-grid">
                <div class="form-group">
                    <label for="vozidlo">Vozidlo (značka a model)</label>
                    <input type="text" id="vozidlo" name="vozidlo" maxlength="100" required
                           placeholder="napr. Audi A4" value="<?= e($zakazka->getVozidlo()) ?>">
                </div>
                <div class="form-group">
                    <label for="spz">ŠPZ</label>
                    <input type="text" id="spz" name="spz" maxlength="20" required
                           placeholder="napr. ZA123AB" value="<?= e($zakazka->getSpz()) ?>">
                </div>
                <div class="form-group">
                    <label for="zakaznik">Zákazník</label>
                    <input type="text" id="zakaznik" name="zakaznik" maxlength="100" required
                           placeholder="Meno a priezvisko" value="<?= e($zakazka->getZakaznik()) ?>">
                </div>
                <div class="form-group">
                    <label for="stav">Stav</label>
                    <select id="stav" name="stav">
                        <?php foreach (Zakazka::STAVY as $stav): ?>
                            <option value="<?= e($stav) ?>" <?= $zakazka->getStav() === $stav ? 'selected' : '' ?>>
                                <?= e($stav) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="priorita">Priorita</label>
                    <select id="priorita" name="priorita">
                        <?php foreach (Zakazka::PRIORITY as $priorita): ?>
                            <option value="<?= e($priorita) ?>" <?= $zakazka->getPriorita() === $priorita ? 'selected' : '' ?>>
                                <?= e($priorita) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group full">
                    <label for="popis">Popis poruchy</label>
                    <textarea id="popis" name="popis" rows="4"
                              placeholder="Stručný popis poruchy"><?= e($zakazka->getPopis()) ?></textarea>
                </div>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn-apply">Uložiť</button>
                <a href="<?= $link->url('home.sluzby') ?>" class="btn-apply btn-link">Zrušiť</a>
            </div>
        </form>
    </section>
</main>