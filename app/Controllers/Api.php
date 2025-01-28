<?php

namespace App\Controllers;

class Api extends BaseController {
    public function indexOld() {
        return view('welcome_message');
    }
    public function index() {
        return $this->setResponse([
            'app_name' => getenv('APP_NAME'),
            'app_version' => getenv('APP_VERSION')
        ]);
    }

    // sum of array | input: request body | Rule: int array | return: response JSON;
    public function sumArray() {
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
    public function sumAltArray() {
        $input = $this->request->getJson(true);
        $rules = ['numbers.*' => 'required|integer'];
        if (!$this->validateData($input, $rules)) {
            // The validation failed.
            return $this->setResponse([
                'status' => 'failed',
                'errors' => $this->validator->getErrors(),
            ], 400);
        }
        $oddArr = array_filter($input['numbers'], function($num) {
            return $num % 2 !== 0;
        });
        $eveArr = array_filter($input['numbers'], function($num) {
            return $num % 2 == 0;
        });
        return $this->setResponse([
            'status' => 'success',
            'oddSum' => array_sum($oddArr),
            'eveSum' => array_sum($eveArr)
        ], 200);
    }
}
