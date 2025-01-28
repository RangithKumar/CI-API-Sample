<?php

namespace App\Controllers;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;


class ApiControllerTest extends CIUnitTestCase
{
    use ControllerTestTrait;
    public function testArraySum()
    {
        $request = new \CodeIgniter\HTTP\IncomingRequest(
            new \Config\App(),
            new \CodeIgniter\HTTP\URI(base_url()),
            new \CodeIgniter\HTTP\Header('Content-Type: application/json, Api-Key: ' . env('API_KEY')),
            new \CodeIgniter\HTTP\UserAgent(),
            new \CodeIgniter\HTTP\Message(['numbers' => [1, 2, 3, 4, 5]]),
        );
        $result = $this->withRequest($request)
            ->withUri(base_url() . 'categories')
            ->controller(Api::class)
            ->execute('sumArray');

        $this->assertTrue($result->isOK());
    }
}
