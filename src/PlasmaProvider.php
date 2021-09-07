<?php

namespace Phox\Nebula\Plasma;

use Phox\Nebula\Atom\Implementation\StateContainer;
use Phox\Nebula\Atom\Notion\Abstracts\Provider;
use Phox\Nebula\Atom\Notion\Interfaces\IDependencyInjection;
use Phox\Nebula\Plasma\Implementation\StarHandler;
use Phox\Nebula\Plasma\Implementation\StarResolver;
use Phox\Nebula\Plasma\Implementation\States\RenderState;
use Phox\Nebula\Plasma\Implementation\States\StarState;

class PlasmaProvider extends Provider 
{
    public function __invoke(StateContainer $stateContainer, IDependencyInjection $dependencyInjection): void
    {
        $dependencyInjection->singleton(new StarResolver());
        $dependencyInjection->singleton(new StarHandler());

        $this->initStates($stateContainer);
    }

    private function initStates(StateContainer $stateContainer): void
    {
        $starState = new StarState();
        $starState->listen(
            fn(StarResolver $starResolver, StarHandler $starHandler) => $starHandler->handle($starResolver)
        );

        $renderState = new RenderState();
        $renderState->listen(
            fn(StarResolver $starResolver, StarHandler $starHandler) => $starHandler->render($starResolver)
        );

        $stateContainer->add($starState);
        $stateContainer->addAfter($renderState, StarState::class);
    }
}