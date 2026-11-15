CREATE TABLE IF NOT EXISTS `auta` (
                                      `spz`      VARCHAR(20)  NOT NULL,
                                      `vozidlo`  VARCHAR(100) NOT NULL,
                                      `rok`      SMALLINT     DEFAULT NULL,
                                      PRIMARY KEY (`spz`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `zakazky` (
                                         `id`        INT(11)      NOT NULL AUTO_INCREMENT,
                                         `spz`       VARCHAR(20)  NOT NULL,
                                         `zakaznik`  VARCHAR(100) NOT NULL,
                                         `stav`      VARCHAR(30)  NOT NULL DEFAULT 'Čaká',
                                         `priorita`  VARCHAR(30)  NOT NULL DEFAULT 'Normálna',
                                         `popis`     TEXT         DEFAULT NULL,
                                         PRIMARY KEY (`id`),
                                         KEY `idx_zakazky_spz` (`spz`),
                                         CONSTRAINT `fk_zakazky_auta`
                                             FOREIGN KEY (`spz`) REFERENCES `auta` (`spz`)
                                                 ON UPDATE CASCADE
                                                 ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `auta` (`spz`, `vozidlo`, `rok`) VALUES
                                                 ('ZA123AB', 'Audi A4',       2015),
                                                 ('BL999XY', 'VW Golf',       2018),
                                                 ('MT456CD', 'Škoda Octavia', 2020),
                                                 ('SE954DI', 'Honda Prelude', 1999);

INSERT INTO `zakazky` (`spz`, `zakaznik`, `stav`, `priorita`, `popis`) VALUES
                                                                           ('ZA123AB', 'Ján Novák',    'V oprave', 'Vysoká',   'Búchanie v prednej náprave'),
                                                                           ('BL999XY', 'Peter Múdry',  'Čaká',     'Normálna', 'Výmena oleja a filtrov'),
                                                                           ('MT456CD', 'Marek Urban',  'Hotové',   'Nízka',    'Diagnostika a výmena sviečok'),
                                                                           ('SE954DI', 'Filip Zvonek', 'V oprave', 'Vysoká',   'Oprava brzdy a výmena kotúčov');