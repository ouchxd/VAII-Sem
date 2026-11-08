<?php

/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Zakazka[] $zakazky */
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
                <label>Zákazník</label>
                <input type="text" placeholder="Zadajte zákazníka">
            </div>
            <div class="form-group">
                <label>ID</label>
                <input type="text" placeholder="Zadajte ID">
            </div>
            <div class="form-group">
                <label>Stav</label>
                <select>
                    <option>Vyberte stav</option>
                </select>
            </div>
            <div class="form-group">
                <label>Priorita</label>
                <select>
                    <option>Vyberte prioritu</option>
                </select>
            </div>
            <div class="form-group">
                <label>Značka vozidla</label>
                <input type="text" placeholder="Zadajte značku">
            </div>
            <button type="button" class="btn-apply">Aplikovať filter</button>
        </form>
    </aside>

    <section class="table-section">
        <div class="table-toolbar">
            <a href="<?= $link->url('zakazka.add') ?>" class="btn-add">
                <i class="fa-solid fa-plus"></i> Pridať zákazku
            </a>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Vozidlo (ŠPZ)</th>
                    <th>Zákazník</th>
                    <th>Stav</th>
                    <th>Priorita</th>
                    <th>Popis poruchy</th>
                    <th>Akcie</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($zakazky as $zakazka): ?>
                    <tr>
                        <td data-label="ID">#<?= e($zakazka->getId()) ?></td>
                        <td data-label="Vozidlo (ŠPZ)"><?= e($zakazka->getVozidlo()) ?> (<?= e($zakazka->getSpz()) ?>)</td>
                        <td data-label="Zákazník"><?= e($zakazka->getZakaznik()) ?></td>
                        <td data-label="Stav"><?= e($zakazka->getStav()) ?></td>
                        <td data-label="Priorita"><?= e($zakazka->getPriorita()) ?></td>
                        <td data-label="Popis poruchy"><?= e($zakazka->getPopis()) ?></td>
                        <td data-label="Akcie" class="actions">
                            <a href="<?= $link->url('zakazka.delete', ['id' => $zakazka->getId()]) ?>"
                               title="Odstrániť" onclick="return confirm('Naozaj odstrániť zákazku #<?= e($zakazka->getId()) ?>?');">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                            <a href="<?= $link->url('zakazka.edit', ['id' => $zakazka->getId()]) ?>" title="Upraviť">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($zakazky)): ?>
                    <tr>
                        <td colspan="7" class="empty-row">Zatiaľ nie sú evidované žiadne zákazky.</td>
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
                <a href="<?= $link->url('home.sluzby', ['page' => 1]) ?>" title="Prvá strana"><i class="fa-solid fa-angles-left"></i></a>
                <a href="<?= $link->url('home.sluzby', ['page' => $strana - 1]) ?>" title="Predošlá strana"><i class="fa-solid fa-angle-left"></i></a>
            <?php else: ?>
                <i class="fa-solid fa-angles-left disabled"></i>
                <i class="fa-solid fa-angle-left disabled"></i>
            <?php endif; ?>

            <?php for ($i = $od; $i <= $do; $i++): ?>
                <?php if ($i === $strana): ?>
                    <span class="page current" aria-current="page"><?= $i ?></span>
                <?php else: ?>
                    <a class="page" href="<?= $link->url('home.sluzby', ['page' => $i]) ?>"><?= $i ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($strana < $pocetStran): ?>
                <a href="<?= $link->url('home.sluzby', ['page' => $strana + 1]) ?>" title="Nasledujúca strana"><i class="fa-solid fa-angle-right"></i></a>
                <a href="<?= $link->url('home.sluzby', ['page' => $pocetStran]) ?>" title="Posledná strana"><i class="fa-solid fa-angles-right"></i></a>
            <?php else: ?>
                <i class="fa-solid fa-angle-right disabled"></i>
                <i class="fa-solid fa-angles-right disabled"></i>
            <?php endif; ?>
        </div>
    </section>
</main>