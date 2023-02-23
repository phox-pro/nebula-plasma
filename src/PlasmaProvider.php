<?php

namespace Phox\Nebula\Plasma;

use Phox\Nebula\Atom\Implementation\Services\ServiceContainerAccess;
use Phox\Nebula\Atom\Notion\IProvider;
use Phox\Nebula\Atom\Notion\IStateContainer;
use Phox\Nebula\Plasma\Implementation\ActionHandler;
use Phox\Nebula\Plasma\Implementation\ActionResolver;
use Phox\Nebula\Plasma\Implementation\States\ActionState;
use Phox\Nebula\Plasma\Notion\IActionHandler;
use Phox\Nebula\Plasma\Notion\IActionResolver;

class PlasmaProvider implements IProvider
{
    use ServiceContainerAccess;

    public function register(): void
    {
        $this->container()->singleton(new ActionResolver(), IActionResolver::class);
        $this->container()->singleton(new ActionHandler(), IActionHandler::class);
        $this->container()->get(IStateContainer::class)->add(new ActionState());

        ActionState::listen(function (ActionState $state) {
            $this->container()->get(IActionHandler::class)->handle();
        });
    }
}