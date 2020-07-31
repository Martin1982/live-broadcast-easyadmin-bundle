<?php declare(strict_types=1);

/**
 * This file is part of martin1982/live-broadcast-easyadmin-bundle which is released under MIT.
 * See https://opensource.org/licenses/MIT for full license details.
 */
namespace Martin1982\LiveBroadcastEasyadminBundle\Tests;

use Martin1982\LiveBroadcastEasyadminBundle\LiveBroadcastEasyadminBundle;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class LiveBroadcastEasyadminBundleTest
 */
class LiveBroadcastEasyadminBundleTest extends TestCase
{
    /**
     * Test building the bundle
     */
    public function testBuild(): void
    {
        $container = $this->createMock(ContainerBuilder::class);

        $bundle = new LiveBroadcastEasyadminBundle();

        $bundle->build($container);
        $this->addToAssertionCount(1);
    }
}
