<?php

namespace Tests\Unit;

use Phox\Nebula\Plasma\TestCase;
use Phox\Nebula\Atom\Implementation\Application;
use Phox\Nebula\Plasma\Implementation\Application as PlasmaApplication;
use Phox\Nebula\Plasma\Implementation\Events\StarEvent;
use Phox\Nebula\Plasma\Implementation\Exceptions\StarNotSetted;
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
        /** @var Star $mock */
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

    /**
     * @test
     */
    public function starNotSettedTest()
    {
        /** @var PlasmaApplication $app */
        $app = get(PlasmaApplication::class);
        $this->expectException(StarNotSetted::class);
        $app->run();
    }

    /**
     * @test
     */
    public function echoFromStarTest()
    {
        /** @var PlasmaApplication $app */
        $app = get(PlasmaApplication::class);
        $app->setStar(new class extends Star {
            public function __invoke() {
                return "Hello Test";
            }
        });
        $this->expectOutputString("Hello Test");
        $app->run();
    }

    /**
     * @test
     *
     * @return void
     */
    public function getOutputTest()
    {
        /** @var PlasmaApplication $app */
        $app = get(PlasmaApplication::class);
        $this->assertNull($app->getOutput());
        $app->setStar(new class extends Star {
            public function __invoke() {
                return "Output";
            }
        });
        $this->expectOutputString("Output");
        $app->run();
        $this->assertEquals("Output", $app->getOutput());
    }

    /**
     * @test
     */
    public function outputFromActionTest()
    {
        $app = get(PlasmaApplication::class);
        $app->setStar(new class extends Star {
            public function someAction() {
                return "Work!";
            }
        });
        $app->setAction('someAction');
        $this->expectOutputString("Work!");
        $app->run();
    }

    /**
     * @test
     */
    public function nullabaleStarResultTest()
    {
        /** @var PlasmaApplication $app */
        $app = get(PlasmaApplication::class);
        $app->setStar(new class extends Star {
            public function __invoke() {
                // return void
            }
        });
        $app->run();
        $this->assertNull($app->getOutput());
    }

    /**
     * @test
     */
    public function starEventTest()
    {
        $this->assertEmpty(StarEvent::getListeners());
        $star = new class extends Star {
            public bool $value = false;

            public function __invoke() {
                $this->value = true;
            }
        };
        /** @var PlasmaApplication $app */
        $app = get(PlasmaApplication::class);
        $app->setStar($star);
        $this->assertFalse($app->getStar()->value);
        StarEvent::listen(function (Star $getStar) use ($star) {
            $this->assertSame($getStar, $star);
            $this->assertTrue($getStar->value);
        });
        $app->run();
    }
}