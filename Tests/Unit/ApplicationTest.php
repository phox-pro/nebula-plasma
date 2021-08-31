<?php

namespace Tests\Unit;

use Phox\Nebula\Atom\Implementation\Exceptions\AnotherInjectionExists;
use Phox\Nebula\Atom\Implementation\StateContainer;
use Phox\Nebula\Atom\Notion\Interfaces\IStateContainer;
use Phox\Nebula\Plasma\Implementation\StarResolver;
use Phox\Nebula\Plasma\Implementation\States\StarState;
use Phox\Nebula\Plasma\TestCase;
use Phox\Nebula\Plasma\Notion\Abstracts\Star;

class ApplicationTest extends TestCase 
{
    /**
     * @throws AnotherInjectionExists
     */
    public function testStarStateOutput(): void
    {
        $output = 'testStarStateOutput';

        $star = $this->getMockBuilder(Star::class)
            ->addMethods(['__invoke'])
            ->getMock();
        $star->method('__invoke')->willReturn($output);

        $starResolver = $this->container()->get(StarResolver::class);
        $starResolver->setStar($star);

        $starState = $this->container()
            ->get(IStateContainer::class)
            ->getState(StarState::class);

        $starState->listen(fn(StarResolver $resolver) =>
        $this->assertEquals($output, $resolver->getOutput()));

        $this->expectOutputString($output);

        $this->nebula->run();
    }
}