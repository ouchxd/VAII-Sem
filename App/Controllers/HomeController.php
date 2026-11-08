<?php

namespace App\Controllers;

use App\Models\Zakazka;
use Exception;
use Framework\Http\HttpException;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/**
 * Class HomeController
 * Handles actions related to the home page and other public actions.
 *
 * This controller includes actions that are accessible to all users, including a default landing page and a contact
 * page. It provides a mechanism for authorizing actions based on user permissions.
 *
 * @package App\Controllers
 */
class HomeController extends BaseController
{
    /**
     * Authorizes controller actions based on the specified action name.
     *
     * In this implementation, all actions are authorized unconditionally.
     *
     * @param string $action The action name to authorize.
     * @return bool Returns true, allowing all actions.
     */
    public function authorize(Request $request, string $action): bool
    {
        return true;
    }

    /**
     * Displays the default home page.
     *
     * This action serves the main HTML view of the home page.
     *
     * @return Response The response object containing the rendered HTML for the home page.
     */
    public function index(Request $request): Response
    {
        return $this->html();
    }

    /**
     * Displays the contact page.
     *
     * This action serves the HTML view for the contact page, which is accessible to all users without any
     * authorization.
     *
     * @return Response The response object containing the rendered HTML for the contact page.
     */
    public function contact(Request $request): Response
    {
        return $this->html();
    }

    private const ZAKAZKY_NA_STRANU = 10;

    public function sluzby(Request $request): Response
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
}
