<?php

namespace App\Controllers;

use App\Models\Auto;
use App\Models\Zakazka;
use Exception;
use Framework\Core\BaseController;
use Framework\Http\HttpException;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

class AutoController extends BaseController
{
    private const AUTA_NA_STRANU = 10;

    private const POLIA_ZAKAZKY = ['id', 'spz', 'zakaznik', 'stav', 'priorita', 'popis'];

    public function authorize(Request $request, string $action): bool
    {
        return true;
    }

    /**
     * Zoznam vozidiel so stránkovaním.
     */
    public function index(Request $request): Response
    {
        try {
            $celkovo = Auto::getCount();
            $pocetStran = max(1, (int)ceil($celkovo / self::AUTA_NA_STRANU));
            $strana = min(max(1, (int)$request->value('page')), $pocetStran);

            $auta = Auto::getAll(
                orderBy: 'spz',
                limit: self::AUTA_NA_STRANU,
                offset: ($strana - 1) * self::AUTA_NA_STRANU
            );
        } catch (Exception $e) {
            throw new HttpException(500, 'DB Chyba: ' . $e->getMessage());
        }

        return $this->html(compact('auta', 'strana', 'pocetStran'));
    }

    public function add(Request $request): Response
    {
        $zakazka = $request->isPost() ? $this->vyberPoliaZakazky($request->post()) : null;

        return $this->html([
            'auto' => new Auto(),
            'povodnaSpz' => '',
            'chyba' => null,
            'zakazka' => $zakazka,
            'zrusitUrl' => $this->urlZrusit($zakazka),
        ], 'form');
    }

    public function edit(Request $request): Response
    {
        $auto = $this->findOrFail((string)$request->value('spz'));
        return $this->html([
            'auto' => $auto,
            'povodnaSpz' => $auto->getSpz(),
            'chyba' => null,
            'zakazka' => null,
            'zrusitUrl' => $this->urlZrusit(null),
        ], 'form');
    }

    public function save(Request $request): Response
    {
        $povodnaSpz = (string)$request->value('povodnaSpz');
        $auto = $povodnaSpz !== '' ? $this->findOrFail($povodnaSpz) : new Auto();

        $novaSpz = strtoupper(str_replace(' ', '', trim((string)$request->value('spz'))));
        $rok = trim((string)$request->value('rok'));

        $zakazka = is_array($request->post('zakazka')) ? $this->vyberPoliaZakazky($request->post('zakazka')) : null;

        try {
            $auto->setFromRequest($request);
            $auto->setSpz($novaSpz);
            $auto->setRok($rok === '' ? null : (int)$rok);

            $chyba = null;
            if ($novaSpz === '') {
                $chyba = 'ŠPZ je povinná.';
            } elseif ($novaSpz !== $povodnaSpz && Auto::getOne($novaSpz) !== null) {
                $chyba = "Vozidlo s ŠPZ $novaSpz už existuje.";
            }

            if ($chyba !== null) {
                $zrusitUrl = $this->urlZrusit($zakazka);
                return $this->html(compact('auto', 'povodnaSpz', 'chyba', 'zakazka', 'zrusitUrl'), 'form');
            }

            $auto->save();
        } catch (Exception $e) {
            throw new HttpException(500, 'DB Chyba: ' . $e->getMessage());
        }

        if ($zakazka !== null) {
            $zakazka['spz'] = $auto->getSpz();
            return $this->redirect($this->urlZakazky($zakazka));
        }

        return $this->redirect($this->url('auto.index'));
    }

    public function delete(Request $request): Response
    {
        $auto = $this->findOrFail((string)$request->value('spz'));

        try {
            if (Zakazka::getCount('`spz` = ?', [$auto->getSpz()]) > 0) {
                throw new HttpException(409, 'Vozidlo nie je možné odstrániť, pretože má priradené zákazky. Najprv odstráňte jeho zákazky.');
            }
            $auto->delete();
        } catch (HttpException $e) {
            throw $e;
        } catch (Exception $e) {
            throw new HttpException(500, 'DB Chyba: ' . $e->getMessage());
        }

        return $this->redirect($this->url('auto.index'));
    }

    /**
     * Z poslaných dát nechá iba polia zákazky (a iba jednoduché hodnoty).
     */
    private function vyberPoliaZakazky(array $data): array
    {
        $polia = array_intersect_key($data, array_flip(self::POLIA_ZAKAZKY));
        return array_filter($polia, 'is_scalar');
    }

    /**
     * URL formulára zákazky, do ktorej sa vraciame (nová zákazka alebo úprava existujúcej) aj s jej údajmi.
     */
    private function urlZakazky(array $zakazka): string
    {
        $id = (int)($zakazka['id'] ?? 0);
        unset($zakazka['id']);

        return $id > 0
            ? $this->url('zakazka.edit', ['id' => $id] + $zakazka)
            : $this->url('zakazka.add', $zakazka);
    }

    /**
     * Kam vedie tlačidlo „Zrušiť“ vo formulári auta.
     */
    private function urlZrusit(?array $zakazka): string
    {
        return $zakazka !== null ? $this->urlZakazky($zakazka) : $this->url('auto.index');
    }

    private function findOrFail(string $spz): Auto
    {
        try {
            $auto = Auto::getOne($spz);
        } catch (Exception $e) {
            throw new HttpException(500, 'DB Chyba: ' . $e->getMessage());
        }
        if ($auto === null) {
            throw new HttpException(404, 'Vozidlo neexistuje.');
        }
        return $auto;
    }
}