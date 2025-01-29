<?php

namespace Tests\Unit;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Covers;
use App\Controllers\Api;
use App\Controllers\BaseController;

#[CoversClass(Api::class)]
#[CoversClass(BaseController::class)]
class ApiControllerTest extends CIUnitTestCase
{
    use ControllerTestTrait;

    #[Covers('App\Controllers\Api::index')]
    #[Covers('App\Controllers\BaseController::setResponse')]
    public function testIndex()
    {
        $result = $this->controller(Api::class)
            ->execute('index');

        $this->assertTrue($result->isOK());
        $respJson = json_decode(strip_tags($result->getBody()), true);
        $this->assertArrayHasKey('app_name', $respJson);
        $this->assertEquals('CI API Sample', $respJson['app_name']);
    }

    #[Covers('App\Controllers\Api::sumArray')]
    #[Covers('App\Controllers\BaseController::setResponse')]
    public function testSumArray()
    {
        $json = json_encode(['numbers' => [1, 2, 3, 4, 5]]);
        $result = $this->withBody($json)
            ->controller(Api::class)
            ->execute('sumArray');

        $this->assertTrue($result->isOK());
        $respJson = json_decode(strip_tags($result->getBody()), true);
        $this->assertEquals(15, $respJson['sum']);
    }

    #[Covers('App\Controllers\Api::sumAltArray')]
    #[Covers('App\Controllers\BaseController::setResponse')]
    public function testSumAltArray()
    {
        $json = json_encode(['numbers' => [1, 2, 3, 4, 5]]);
        $result = $this->withBody($json)
            ->controller(Api::class)
            ->execute('sumAltArray');

        $this->assertTrue($result->isOK());
        $respJson = json_decode(strip_tags($result->getBody()), true);
        $this->assertEquals(9, $respJson['oddSum']);
        $this->assertEquals(6, $respJson['eveSum']);
    }

    #[Covers('App\Controllers\Api::sumArray')]
    #[Covers('App\Controllers\BaseController::setResponse')]
    public function testSumArrayInvalidInput()
    {
        $json = json_encode(['numbers' => [1, 'two', 3, 4, 5]]);
        $result = $this->withBody($json)
            ->controller(Api::class)
            ->execute('sumArray');

        $this->assertFalse($result->isOK());
        $respJson = json_decode(strip_tags($result->getBody()), true);
        $this->assertStringContainsString('failed', $respJson['status']);
    }

    #[Covers('App\Controllers\Api::sumAltArray')]
    #[Covers('App\Controllers\BaseController::setResponse')]
    public function testSumAltArrayInvalidInput()
    {
        $json = json_encode(['numbers' => [1, 'two', 3, 4, 5]]);
        $result = $this->withBody($json)
            ->controller(Api::class)
            ->execute('sumAltArray');

        $this->assertFalse($result->isOK());
        $respJson = json_decode(strip_tags($result->getBody()), true);
        $this->assertStringContainsString('failed', $respJson['status']);
    }
}
