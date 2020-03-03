<?php

namespace Tests\Unit;

use Phox\Nebula\Plasma\TestCase;
use Phox\Nebula\Atom\Implementation\Application;
use Phox\Nebula\Plasma\Implementation\Application as PlasmaApplication;

class ApplicationTest extends TestCase 
{
    /**
     * @test
     */
    public function injectionTest()
    {
        $this->assertInstanceOf(PlasmaApplication::class, get(Application::class));
    }
}