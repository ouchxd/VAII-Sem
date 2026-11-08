CREATE TABLE IF NOT EXISTS `zakazky` (
                                         `id`        INT(11)      NOT NULL AUTO_INCREMENT,
    `vozidlo`   VARCHAR(100) NOT NULL,
    `spz`       VARCHAR(20)  NOT NULL,
    `zakaznik`  VARCHAR(100) NOT NULL,
    `stav`      VARCHAR(30)  NOT NULL DEFAULT 'Čaká',
    `priorita`  VARCHAR(30)  NOT NULL DEFAULT 'Normálna',
    `popis`     TEXT         DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `zakazky` (`vozidlo`, `spz`, `zakaznik`, `stav`, `priorita`, `popis`) VALUES
                                                                                      ('Audi A4',        'ZA123AB', 'Ján Novák',    'V oprave', 'Vysoká',   'Búchanie v prednej náprave'),
                                                                                      ('VW Golf',        'BL999XY', 'Peter Múdry',  'Čaká',     'Normálna', 'Výmena oleja a filtrov'),
                                                                                      ('Škoda Octavia',  'MT456CD', 'Marek Urban',  'Hotové',   'Nízka',    'Diagnostika a výmena sviečok'),
                                                                                      ('Honda Prelude',  'SE954DI', 'Filip Zvonek', 'V oprave', 'Vysoká',   'Oprava brzdy a výmena kotúčov');