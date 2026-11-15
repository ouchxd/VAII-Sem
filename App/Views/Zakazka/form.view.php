<?php

/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Zakazka $zakazka */
/** @var \App\Models\Auto[] $auta */

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
                    <label for="spz">Vozidlo (ŠPZ)</label>
                    <select id="spz" name="spz" required>
                        <option value="">Vyberte vozidlo</option>
                        <?php foreach ($auta as $auto): ?>
                            <option value="<?= e($auto->getSpz()) ?>" <?= $zakazka->getSpz() === $auto->getSpz() ? 'selected' : '' ?>>
                                <?= e($auto->getVozidlo()) ?> (<?= e($auto->getSpz()) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <small class="form-hint">
                        Vozidlo nie je v zozname?
                        <button type="submit" formaction="<?= $link->url('auto.add') ?>" formnovalidate class="link-button">Pridajte ho</button>.                    </small>
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
                <a href="<?= $link->url('zakazka.index') ?>" class="btn-apply btn-link">Zrušiť</a>
            </div>
        </form>
    </section>
</main>