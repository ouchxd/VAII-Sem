<?php

namespace App\Controllers;

use App\Models\Zakazka;
use Exception;
use Framework\Core\BaseController;
use Framework\Http\HttpException;
use Framework\Http\Request;
use Framework\Http\Responses\Response;
use App\Models\Auto;

class ZakazkaController extends BaseController
{

    private const ZAKAZKY_NA_STRANU = 10;

    public function authorize(Request $request, string $action): bool
    {
        return true;
    }

    /**
     * Zoznam zákaziek so stránkovaním.
     */
    public function index(Request $request): Response
    {
        try {
            $celkovo = Zakazka::getCount();
            $pocetStran = max(1, (int)ceil($celkovo / self::ZAKAZKY_NA_STRANU));
            $strana = min(max(1, (int)$request->value('page')), $pocetStran);

            $zakazky = Zakazka::getAll(
                orderBy: 'id',
                limit: self::ZAKAZKY_NA_STRANU,
                offset: ($strana - 1) * self::ZAKAZKY_NA_STRANU
            );
        } catch (Exception $e) {
            throw new HttpException(500, 'DB Chyba: ' . $e->getMessage());
        }

        return $this->html(compact('zakazky', 'strana', 'pocetStran'));
    }

    public function add(Request $request): Response
    {
        $zakazka = new Zakazka();
        $zakazka->setFromRequest($request);

        return $this->html(['zakazka' => $zakazka, 'auta' => $this->nacitajAuta()], 'form');
    }

    public function edit(Request $request): Response
    {
        $zakazka = $this->findOrFail((int)$request->value('id'));
        $zakazka->setFromRequest($request);

        return $this->html(['zakazka' => $zakazka, 'auta' => $this->nacitajAuta()], 'form');
    }

    public function save(Request $request): Response
    {
        $id = (int)$request->value('id');
        $zakazka = $id > 0 ? $this->findOrFail($id) : new Zakazka();

        try {
            $zakazka->setFromRequest($request);
            $zakazka->save();
        } catch (Exception $e) {
            throw new HttpException(500, 'DB Chyba: ' . $e->getMessage());
        }

        return $this->redirect($this->url('zakazka.index'));
    }

    public function delete(Request $request): Response
    {
        $zakazka = $this->findOrFail((int)$request->value('id'));

        try {
            $zakazka->delete();
        } catch (Exception $e) {
            throw new HttpException(500, 'DB Chyba: ' . $e->getMessage());
        }

        return $this->redirect($this->url('zakazka.index'));
    }

    /**
     * Všetky vozidlá pre výber vo formulári zákazky.
     *
     * @return Auto[]
     */
    private function nacitajAuta(): array
    {
        try {
            return Auto::getAll(orderBy: 'vozidlo');
        } catch (Exception $e) {
            throw new HttpException(500, 'DB Chyba: ' . $e->getMessage());
        }
    }

    private function findOrFail(int $id): Zakazka
    {
        try {
            $zakazka = Zakazka::getOne($id);
        } catch (Exception $e) {
            throw new HttpException(500, 'DB Chyba: ' . $e->getMessage());
        }
        if ($zakazka === null) {
            throw new HttpException(404, 'Zákazka neexistuje.');
        }
        return $zakazka;
    }
}