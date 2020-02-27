<?php

namespace App\Controller;

use App\Entity\Number;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/numbers", name="api_")
 */
class APIController extends AbstractController
{
    /**
     * @Route("/add/{number}", name="add",
     *     methods={"POST"},
     *     requirements={"number"="\d+"},
     *     condition="request.get('number') >= 0"
     *     )
     * @param int $number
     * @return JsonResponse
     */
    public function addAction(int $number)
    {
        $result = $this->getDoctrine()
            ->getRepository(Number::class)
            ->addNumber($number);

        if (count($result) == 1) {
            if ($result[0]['number'] != -1) {
                return $this->responseSuccess([
                    'number' => $result[0]['number']
                ]);
            }

            return $this->responseFail('Number already processed');
        }
        return $this->responseFail('Internal server error', 500);
    }

    /**
     * @Route("/", name="list", methods={"GET"})
     * @return JsonResponse
     */
    public function listAction()
    {
        $numbersTable = $this->getDoctrine()
            ->getRepository(Number::class)
            ->findAllWithId();

        $numbers = [];
        foreach ($numbersTable as $number) {
            $numbers[] = $number['number'];
        }

        return $this->responseSuccess([
            'numbers' => $numbers
        ]);
    }

    /**
     * @Route("/", name="delete", methods={"DELETE"})
     * @return JsonResponse
     */
    public function deleteAction()
    {
        $deleted = $this->getDoctrine()
            ->getRepository(Number::class)
            ->removeAll();

        return $this->responseSuccess(['deleted' => $deleted]);
    }


    /**
     * @param string $msg
     * @param int $status
     * @return JsonResponse
     */
    private function responseFail($msg, $status = 404)
    {
        return new JsonResponse(
            [
                'status' => 0,
                'msg' => $msg
            ],
            $status);
    }

    /**
     * @param array $response
     * @param int $status
     * @return JsonResponse
     */
    private function responseSuccess($response = [], $status = 200)
    {
        $response['status'] = 1;
        return new JsonResponse(
            $response,
            $status);
    }
}
