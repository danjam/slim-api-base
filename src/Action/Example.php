<?php

declare(strict_types=1);

namespace SlimApiBase\Action;

use Slim\Http\Request;
use Slim\Http\Response;
use Teapot\StatusCode;

/**
 * Class Example
 *
 * @package SlimApiBase\Action
 */
class Example
{
    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function __invoke(Request $request, Response $response): Response
    {
        return $response->withJson(['success' => true], StatusCode::OK);
    }
}
