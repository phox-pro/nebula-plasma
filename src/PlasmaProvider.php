<?php

namespace Phox\Nebula\Plasma;

use Phox\Nebula\Atom\Implementation\StateContainer;
use Phox\Nebula\Atom\Notion\Abstracts\Provider;
use Phox\Nebula\Atom\Notion\Interfaces\IDependencyInjection;
use Phox\Nebula\Atom\Notion\Interfaces\IStateContainer;
use Phox\Nebula\Plasma\Implementation\StarHandler;
use Phox\Nebula\Plasma\Implementation\StarResolver;
use Phox\Nebula\Plasma\Implementation\States\RenderState;
use Phox\Nebula\Plasma\Implementation\States\StarState;

class PlasmaProvider extends Provider 
{
    public function __invoke(IStateContainer $stateContainer, IDependencyInjection $dependencyInjection): void
    {
        $dependencyInjection->singleton(StarResolver::class);
        $dependencyInjection->singleton(StarHandler::class);

        $this->initStates($stateContainer);
    }

    private function initStates(IStateContainer $stateContainer): void
    {
        $starState = new StarState();
        $starState->listen(
            fn(StarResolver $starResolver, StarHandler $starHandler) => $starHandler->handle($starResolver)
        );

        $stateContainer->add($starState);
    }
}