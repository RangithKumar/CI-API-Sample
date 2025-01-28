<?php

namespace App\Controllers;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;


class ApiControllerTest extends CIUnitTestCase
{
    public $request = new \CodeIgniter\HTTP\IncomingRequest(
        new \Config\App(),
        new \CodeIgniter\HTTP\URI(base_url()),
        new \CodeIgniter\HTTP\Header('Content-Type: application/json, Api-Key: ' . env('API_KEY')),
        new \CodeIgniter\HTTP\UserAgent(),
    );
    use ControllerTestTrait;
    public function testArraySum()
    {
        $result = $this->withRequest($this->request)
            ->withUri(base_url() . 'categories')
            ->controller(Api::class)
            ->execute('sumArray');

        $this->assertTrue($result->isOK());
    }
}
