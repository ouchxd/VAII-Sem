<?php

namespace App\Models;

use Framework\Core\Model;

class Zakazka extends Model
{
    protected static ?string $tableName = 'zakazky';

    protected static ?array $fillable = ['spz', 'zakaznik', 'stav', 'priorita', 'popis'];

    public const STAVY = ['Čaká', 'V oprave', 'Hotové'];
    public const PRIORITY = ['Nízka', 'Normálna', 'Vysoká'];

    protected ?int $id = null;
    protected ?string $spz = null;
    protected ?string $zakaznik = null;
    protected ?string $stav = 'Čaká';
    protected ?string $priorita = 'Normálna';
    protected ?string $popis = null;

    public function getId(): ?int { return $this->id; }

    public function getSpz(): ?string { return $this->spz; }
    public function setSpz(?string $spz): void { $this->spz = $spz; }

    public function getZakaznik(): ?string { return $this->zakaznik; }
    public function setZakaznik(?string $zakaznik): void { $this->zakaznik = $zakaznik; }

    public function getStav(): ?string { return $this->stav; }
    public function setStav(?string $stav): void { $this->stav = $stav; }

    public function getPriorita(): ?string { return $this->priorita; }
    public function setPriorita(?string $priorita): void { $this->priorita = $priorita; }

    public function getPopis(): ?string { return $this->popis; }
    public function setPopis(?string $popis): void { $this->popis = $popis; }

    /**
     * Vozidlo, ku ktorému zákazka patrí (načítané cez cudzí kľúč `spz`).
     */
    public function getAuto(): ?Auto
    {
        return $this->getOneRelated(Auto::class, 'spz');
    }
}