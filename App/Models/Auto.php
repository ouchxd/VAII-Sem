<?php

namespace App\Models;

use Framework\Core\Model;

class Auto extends Model
{
    protected static ?string $tableName = 'auta';

    protected static ?string $primaryKey = 'spz';

    protected static ?array $fillable = ['vozidlo'];

    protected ?string $spz = null;
    protected ?string $vozidlo = null;
    protected ?int $rok = null;

    public function getSpz(): ?string { return $this->spz; }
    public function setSpz(?string $spz): void { $this->spz = $spz; }

    public function getVozidlo(): ?string { return $this->vozidlo; }
    public function setVozidlo(?string $vozidlo): void { $this->vozidlo = $vozidlo; }

    public function getRok(): ?int { return $this->rok; }
    public function setRok(?int $rok): void { $this->rok = $rok; }

    /**
     * Všetky zákazky tohto vozidla (1:N cez stĺpec `spz` v tabuľke `zakazky`).
     *
     * @return Zakazka[]
     */
    public function getZakazky(): array
    {
        return $this->getAllRelated(Zakazka::class, 'spz');
    }
}