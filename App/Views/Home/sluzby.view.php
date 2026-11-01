<?php

/** @var \Framework\Support\LinkGenerator $link */
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
                <tr>
                    <td data-label="ID">#101</td>
                    <td data-label="Vozidlo (ŠPZ)">Audi A4 (ZA123AB)</td>
                    <td data-label="Zákazník">Ján Novák</td>
                    <td data-label="Stav">V oprave</td>
                    <td data-label="Priorita">Vysoká</td>
                    <td data-label="Popis poruchy">Búchanie v prednej náprave</td>
                    <td data-label="Akcie" class="actions">
                        <i class="fa-solid fa-trash-can"></i>
                        <i class="fa-solid fa-eye"></i>
                    </td>
                </tr>
                <tr>
                    <td data-label="ID">#102</td>
                    <td data-label="Vozidlo (ŠPZ)">VW Golf (BL999XY)</td>
                    <td data-label="Zákazník">Peter Múdry</td>
                    <td data-label="Stav">Čaká</td>
                    <td data-label="Priorita">Normálna</td>
                    <td data-label="Popis poruchy">Výmena oleja a filtrov</td>
                    <td data-label="Akcie" class="actions">
                        <i class="fa-solid fa-trash-can"></i>
                        <i class="fa-solid fa-eye"></i>
                    </td>
                </tr>
                <tr>
                    <td data-label="ID">#103</td>
                    <td data-label="Vozidlo (ŠPZ)">Škoda Octavia (MT456CD)</td>
                    <td data-label="Zákazník">Marek Urban</td>
                    <td data-label="Stav">Hotové</td>
                    <td data-label="Priorita">Nízka</td>
                    <td data-label="Popis poruchy">Diagnostika a výmena sviečok</td>
                    <td data-label="Akcie" class="actions">
                        <i class="fa-solid fa-trash-can"></i>
                        <i class="fa-solid fa-eye"></i>
                    </td>
                </tr>
                <tr>
                    <td data-label="ID">#104</td>
                    <td data-label="Vozidlo (ŠPZ)">Honda Prelude (SE954DI)</td>
                    <td data-label="Zákazník">Filip Zvonek</td>
                    <td data-label="Stav">V oprave</td>
                    <td data-label="Priorita">Vysoká</td>
                    <td data-label="Popis poruchy">Oprava brzdy a výmena kotúčov</td>
                    <td data-label="Akcie" class="actions">
                        <i class="fa-solid fa-trash-can"></i>
                        <i class="fa-solid fa-eye"></i>
                    </td>
                </tr>
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
