<?php

namespace Tests\Unit;

use Phox\Nebula\Atom\Implementation\Application;
use Phox\Nebula\Atom\Implementation\InitState;
use Phox\Nebula\Atom\Implementation\Services\ServiceContainerFacade;
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

        $this->assertProviderExists(PlasmaProvider::class);

        $app->run();

        $this->assertStateExists(ActionState::class);
    }

    public function testSateSuccessRun(): void
    {
        $app = new Application();

        $this->assertEventWillFire(ActionState::class);

        $app->run();
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