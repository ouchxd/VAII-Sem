<?php

/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Auto[] $auta */
/** @var int $strana aktuálna strana */
/** @var int $pocetStran celkový počet strán */
?>

<main>
    <aside class="filter-panel">
        <h2>FILTER</h2>
        <form action="#" method="GET">
            <div class="form-group">
                <label>ŠPZ</label>
                <input type="text" placeholder="Zadajte ŠPZ">
            </div>
            <div class="form-group">
                <label>Značka vozidla</label>
                <input type="text" placeholder="Zadajte značku">
            </div>
            <div class="form-group">
                <label>Rok výroby</label>
                <input type="text" placeholder="Zadajte rok">
            </div>
            <button type="button" class="btn-apply">Aplikovať filter</button>
        </form>
    </aside>

    <section class="table-section">
        <div class="table-toolbar">
            <a href="<?= $link->url('auto.add') ?>" class="btn-add">
                <i class="fa-solid fa-plus"></i> Pridať vozidlo
            </a>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                <tr>
                    <th>ŠPZ</th>
                    <th>Vozidlo</th>
                    <th>Rok výroby</th>
                    <th>Počet zákaziek</th>
                    <th>Akcie</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($auta as $auto): ?>
                    <?php $pocetZakaziek = count($auto->getZakazky()); ?>
                    <tr>
                        <td data-label="ŠPZ"><?= e($auto->getSpz()) ?></td>
                        <td data-label="Vozidlo"><?= e($auto->getVozidlo()) ?></td>
                        <td data-label="Rok výroby"><?= e($auto->getRok() ?? '–') ?></td>
                        <td data-label="Počet zákaziek"><?= $pocetZakaziek ?></td>
                        <td data-label="Akcie" class="actions">
                            <?php if ($pocetZakaziek === 0): ?>
                                <a href="<?= $link->url('auto.delete', ['spz' => $auto->getSpz()]) ?>"
                                   title="Odstrániť" onclick="return confirm('Naozaj odstrániť vozidlo <?= e($auto->getSpz()) ?>?');">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            <?php else: ?>
                                <span title="Vozidlo má priradené zákazky, nedá sa odstrániť">
                                    <i class="fa-solid fa-trash-can disabled"></i>
                                </span>
                            <?php endif; ?>
                            <a href="<?= $link->url('auto.edit', ['spz' => $auto->getSpz()]) ?>" title="Upraviť">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($auta)): ?>
                    <tr>
                        <td colspan="5" class="empty-row">Zatiaľ nie sú evidované žiadne vozidlá.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php
        $od = max(1, $strana - 2);
        $do = min($pocetStran, $strana + 2);
        ?>
        <div class="pagination" role="navigation" aria-label="Stránkovanie">
            <?php if ($strana > 1): ?>
                <a href="<?= $link->url('auto.index', ['page' => 1]) ?>" title="Prvá strana"><i class="fa-solid fa-angles-left"></i></a>
                <a href="<?= $link->url('auto.index', ['page' => $strana - 1]) ?>" title="Predošlá strana"><i class="fa-solid fa-angle-left"></i></a>
            <?php else: ?>
                <i class="fa-solid fa-angles-left disabled"></i>
                <i class="fa-solid fa-angle-left disabled"></i>
            <?php endif; ?>

            <?php for ($i = $od; $i <= $do; $i++): ?>
                <?php if ($i === $strana): ?>
                    <span class="page current" aria-current="page"><?= $i ?></span>
                <?php else: ?>
                    <a class="page" href="<?= $link->url('auto.index', ['page' => $i]) ?>"><?= $i ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($strana < $pocetStran): ?>
                <a href="<?= $link->url('auto.index', ['page' => $strana + 1]) ?>" title="Nasledujúca strana"><i class="fa-solid fa-angle-right"></i></a>
                <a href="<?= $link->url('auto.index', ['page' => $pocetStran]) ?>" title="Posledná strana"><i class="fa-solid fa-angles-right"></i></a>
            <?php else: ?>
                <i class="fa-solid fa-angle-right disabled"></i>
                <i class="fa-solid fa-angles-right disabled"></i>
            <?php endif; ?>
        </div>
    </section>
</main>