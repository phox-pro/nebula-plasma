<?php

namespace Tests\Unit;

use Phox\Nebula\Plasma\TestCase;
use Phox\Nebula\Atom\Implementation\Application;
use Phox\Nebula\Plasma\Implementation\Application as PlasmaApplication;
use Phox\Nebula\Plasma\Notion\Abstracts\Star;

class ApplicationTest extends TestCase 
{
    /**
     * @test
     */
    public function injectionTest()
    {
        $this->assertInstanceOf(PlasmaApplication::class, get(Application::class));
    }

    /**
     * @test
     */
    public function starSetTest()
    {
        /** @var PlasmaApplication $app */
        $app = get(PlasmaApplication::class);
        $this->assertNull($app->getStar());
        $mock = $this->createMock(Star::class);
        $app->setStar($mock);
        $this->assertInstanceOf(Star::class, $app->getStar());
        $this->assertSame($mock, $app->getStar());
    }

    /**
     * @test
     */
    public function actionSetTest()
    {
        /** @var PlasmaApplication $app */
        $app = get(PlasmaApplication::class);
        $mock = $this->createMock(Star::class);
        $this->assertNull($app->getAction());
        $app->setAction('action');
        $this->assertEquals('action', $app->getAction());
        $app->setAction();
        $this->assertNull($app->getAction());
    }
}