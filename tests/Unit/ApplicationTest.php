<?php

namespace Tests\Unit;

use Phox\Nebula\Atom\Implementation\Application;
use Phox\Nebula\Atom\Implementation\InitState;
use Phox\Nebula\Atom\Implementation\Services\ServiceContainerFacade;
use Phox\Nebula\Atom\Notion\IProviderContainer;
use Phox\Nebula\Atom\Notion\IStateContainer;
use Phox\Nebula\Plasma\Implementation\ActionResults\StringActionResult;
use Phox\Nebula\Plasma\Implementation\States\ActionState;
use Phox\Nebula\Plasma\Notion\IAction;
use Phox\Nebula\Plasma\Notion\IActionResolver;
use Phox\Nebula\Plasma\PlasmaProvider;
use Phox\Nebula\Plasma\TestCase;
use PHPUnit\Framework\MockObject\Exception;

class ApplicationTest extends TestCase
{
    public function testLoadInstances(): void
    {
        $app = new Application();

        $foundProvider = false;

        foreach (ServiceContainerFacade::get(IProviderContainer::class)->getProviders() as $provider) {
            if ($provider instanceof PlasmaProvider) {
                $foundProvider = true;
            }
        }

        $this->assertTrue($foundProvider);

        $app->run();

        $this->assertNotNull(
            ServiceContainerFacade::get(IStateContainer::class)->getState(ActionState::class)
        );
    }

    /**
     * @throws Exception
     */
    public function testActionComplete(): void
    {
        $app = new Application();
        $actionResultMessage = 'Action result from test';

        $actionMock = $this->createMock(IAction::class);
        $actionMock->expects($this->once())
            ->method('run')
            ->willReturn(new StringActionResult($actionResultMessage));

        InitState::listen(
            fn() => ServiceContainerFacade::get(IActionResolver::class)->setAction($actionMock)
        );

        $this->expectOutputString($actionResultMessage);

        $app->run();
    }
}