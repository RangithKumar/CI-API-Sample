<?php

namespace App\Controllers;

use OpenApi\Generator;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SwagDocGen extends BaseController
{

    /**
     * Generate OpenAPI documentation for the API ...
     * @return string
     */
    public function generate(): string
    {
        // Specify the path where your API controllers are located
        $openapi = Generator::scan([APPPATH . 'Controllers']);

        $swaggerContent = $openapi->toJson();

        // Save the generated OpenAPI content to a file
        $filePath = FCPATH . 'swagger/swagger.json';
        file_put_contents($filePath, $swaggerContent);

        return $swaggerContent;
    }

    /**
     * Render the SwaggerUI ...
     * @return string
     */
    public function index()
    {
        return view('docs/index');
    }
}
