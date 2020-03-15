<?php

declare(strict_types=1);

namespace Kreait\Firebase\Tests\Unit\ServiceAccount;

use Kreait\Firebase\Exception\ServiceAccountDiscoveryFailed;
use Kreait\Firebase\ServiceAccount\Discoverer;
use Kreait\Firebase\Tests\UnitTestCase;

/**
 * @internal
 */
class DiscovererTest extends UnitTestCase
{
    public function testItHasDefaultMethods()
    {
        $discoverer = new Discoverer();
        $rc = new \ReflectionClass($discoverer);
        $property = $rc->getProperty('methods');
        $property->setAccessible(true);

        $this->assertGreaterThan(0, \count($property->getValue($discoverer)));
    }

    public function testItDiscoversAServiceAccount()
    {
        $serviceAccount = $this->createServiceAccountMock();

        $method = static function () use ($serviceAccount) {
            return $serviceAccount;
        };

        $discoverer = new Discoverer([$method]);
        $this->assertSame($serviceAccount, $discoverer->discover());
    }

    public function testItFailsWithADistinctException()
    {
        $exception = new \Exception('Not found');

        $method = static function () use ($exception) {
            throw $exception;
        };

        $discoverer = new Discoverer([$method]);

        $this->expectException(ServiceAccountDiscoveryFailed::class);

        $discoverer->discover();
    }
}
