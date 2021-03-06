<?php

declare(strict_types=1);

namespace ShlinkioApiTest\Shlink\Rest\Middleware;

use Shlinkio\Shlink\TestUtils\ApiTest\ApiTestCase;

use function explode;

class ImplicitOptionsTest extends ApiTestCase
{
    /** @test */
    public function optionsRequestsReturnEmptyResponse(): void
    {
        $resp = $this->callApi(self::METHOD_OPTIONS, '/short-urls');

        self::assertEquals(self::STATUS_NO_CONTENT, $resp->getStatusCode());
        self::assertEmpty((string) $resp->getBody());
    }

    /** @test */
    public function optionsRequestsReturnAllowedMethodsForEndpoint(): void
    {
        $resp = $this->callApi(self::METHOD_OPTIONS, '/short-urls');
        $allowedMethods = $resp->getHeaderLine('Allow');

        self::assertEquals([
            self::METHOD_GET,
            self::METHOD_POST,
        ], explode(',', $allowedMethods));
    }
}
