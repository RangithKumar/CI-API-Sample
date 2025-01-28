<?php

namespace App\Controllers;

class Api extends BaseController
{

    /**
     * @OA\Post(
     *     path="/api/",
     *     tags={"api / index"},
     *     summary="REST API Index.",
     *     description="REST API Details.",
     *     @OA\Response(
     *         response=200,
     *         description="API Details",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="app_name",
     *                 type="string",
     *                 example="CI Sample API"
     *             ),
     *             @OA\Property(
     *                 property="app_version",
     *                 type="string",
     *                 example="0.0.1"
     *             )
     *         )
     *     ),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function indexOld()
    {
        return view('welcome_message');
    }

    /**
     * @OA\Post(
     *     path="/api/old",
     *     tags={"api / indexOld"},
     *     summary="REST API IndexOld.",
     *     description="REST API Details.",
     *     @OA\Response(
     *         response=200,
     *         description="API Details",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="app_name",
     *                 type="string",
     *                 example="CI Sample API"
     *             ),
     *             @OA\Property(
     *                 property="app_version",
     *                 type="string",
     *                 example="0.0.1"
     *             )
     *         )
     *     ),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function index()
    {
        return $this->setResponse([
            'app_name' => getenv('APP_NAME'),
            'app_version' => getenv('APP_VERSION')
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/sum",
     *     tags={"api / ArraySum"},
     *     summary="REST API ArraySum.",
     *     description="REST API for making sum of array.",
     *     security={{"Api-Key":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="numbers",
     *                 type="array",
     *                 @OA\Items(
     *                     type="number",
     *                     example="[1,2,3,4,5]",
     *                 ),
     *                 description="array of numbers to sum."
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="API Details",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="success"
     *             ),
     *             @OA\Property(
     *                 property="sum",
     *                 type="number",
     *                 example=15
     *             )
     *         )
     *     ),
     *     @OA\Response(response=400, description="Invalid Input."),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function sumArray()
    {
        $input = $this->request->getJson(true);
        $rules = ['numbers.*' => 'required|integer'];
        if (!$this->validateData($input, $rules)) {
            // The validation failed.
            return $this->setResponse([
                'status' => 'failed',
                'errors' => $this->validator->getErrors(),
            ], 400);
        }
        return $this->setResponse(['status' => 'success', 'sum' => array_sum($input['numbers'])], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/sumAlt",
     *     tags={"api / ArrayOddEvenSums"},
     *     summary="REST API Array Odd & Even Sum.",
     *     description="REST API for making sum of odds & evens in an array.",
     *     security={{"Api-Key":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="numbers",
     *                 type="array",
     *                 @OA\Items(
     *                     type="number",
     *                     example="[1,2,3,4,5]",
     *                 ),
     *                 description="array of numbers to sum."
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="API Details",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="success"
     *             ),
     *             @OA\Property(
     *                 property="oddSum",
     *                 type="number",
     *                 example=9
     *             ),
     *             @OA\Property(
     *                 property="evenSum",
     *                 type="number",
     *                 example=6
     *             )
     *         )
     *     ),
     *     @OA\Response(response=400, description="Invalid Input."),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function sumAltArray()
    {
        $input = $this->request->getJson(true);
        $rules = ['numbers.*' => 'required|integer'];
        if (!$this->validateData($input, $rules)) {
            // The validation failed.
            return $this->setResponse([
                'status' => 'failed',
                'errors' => $this->validator->getErrors(),
            ], 400);
        }
        $oddArr = array_filter($input['numbers'], function ($num) {
            return $num % 2 !== 0;
        });
        $eveArr = array_filter($input['numbers'], function ($num) {
            return $num % 2 == 0;
        });
        return $this->setResponse([
            'status' => 'success',
            'oddSum' => array_sum($oddArr),
            'eveSum' => array_sum($eveArr)
        ], 200);
    }
}
