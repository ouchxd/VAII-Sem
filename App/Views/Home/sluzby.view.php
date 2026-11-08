<?php

/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Zakazka[] $zakazky */
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

        <div class="pagination">
            <i class="fa-solid fa-angle-left"></i>
            <i class="fa-solid fa-angles-left"></i>
            <span>1</span>
            <i class="fa-solid fa-angles-right"></i>
            <i class="fa-solid fa-angle-right"></i>
        </div>
    </section>
</main>