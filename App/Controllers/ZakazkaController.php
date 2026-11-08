<?php

namespace App\Controllers;

use App\Models\Zakazka;
use Exception;
use Framework\Core\BaseController;
use Framework\Http\HttpException;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

class ZakazkaController extends BaseController
{
    public function authorize(Request $request, string $action): bool
    {
        return true;
    }

    public function index(Request $request): Response
    {
        return $this->redirect($this->url('home.sluzby'));
    }

    public function add(Request $request): Response
    {
        return $this->html(['zakazka' => new Zakazka()], 'form');
    }

    public function edit(Request $request): Response
    {
        $zakazka = $this->findOrFail((int)$request->value('id'));
        return $this->html(['zakazka' => $zakazka], 'form');
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

        return $this->redirect($this->url('home.sluzby'));
    }

    public function delete(Request $request): Response
    {
        $zakazka = $this->findOrFail((int)$request->value('id'));

        try {
            $zakazka->delete();
        } catch (Exception $e) {
            throw new HttpException(500, 'DB Chyba: ' . $e->getMessage());
        }

        return $this->redirect($this->url('home.sluzby'));
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