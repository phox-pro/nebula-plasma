<?php

namespace Tests\Unit;

use Phox\Nebula\Atom\Implementation\Exceptions\AnotherInjectionExists;
use Phox\Nebula\Plasma\Implementation\StarResolver;
use Phox\Nebula\Plasma\TestCase;
use Phox\Nebula\Plasma\Notion\Abstracts\Star;

class ApplicationTest extends TestCase 
{
    /**
     * @throws AnotherInjectionExists
     */
    public function testCanRenderOutput(): void
    {
        $output = 'Test Star at testCanRenderOutput';

        $star = $this->getMockBuilder(Star::class)
            ->addMethods(['init'])
            ->getMock();
        $star->method('init')->willReturn($output);

        $starResolver = $this->container()->get(StarResolver::class);

        $starResolver->setStar($star);
        $starResolver->setAction('init');

        $this->expectOutputString($output);

        $this->nebula->run();
    }
}