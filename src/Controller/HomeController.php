<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @return JsonResponse
     */
    public function indexAction()
    {
        $routes = [
            'GET api/numbers/' => 'method to show all the numbers in the DB',
            'DELETE api/numbers/' => 'method to remove all the numbers from DB',
            'POST api/numbers/add/{id}' => 'method to add new number to db',
        ];

        return new JsonResponse($routes, 200);
    }
}
