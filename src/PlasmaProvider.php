<?php

namespace Phox\Nebula\Plasma;

use Phox\Nebula\Atom\Notion\Abstracts\Provider;
use Phox\Nebula\Atom\Notion\Interfaces\IDependencyInjection;
use Phox\Nebula\Atom\Notion\Interfaces\IStateContainer;
use Phox\Nebula\Plasma\Implementation\StarHandler;
use Phox\Nebula\Plasma\Implementation\StarResolver;
use Phox\Nebula\Plasma\Implementation\States\RenderState;

class PlasmaProvider extends Provider 
{
    public function __invoke(IStateContainer $stateContainer, IDependencyInjection $dependencyInjection): void
    {
        $dependencyInjection->singleton(new StarResolver());
        $dependencyInjection->singleton(new StarHandler());

        $renderState = new RenderState();
        $renderState->listen(fn(StarResolver $starResolver, StarHandler $starHandler) => $this->render($starResolver, $starHandler));

        $stateContainer->add($renderState);
    }

    private function render(StarResolver $starResolver, StarHandler $starHandler): void
    {
        $starHandler->eStarCompleted->listen(fn(mixed $result) => $this->echoOutput($result));

        $starHandler->handle($starResolver);
    }

    private function echoOutput(mixed $result): void
    {
        if (is_scalar($result)) {
            echo $result;
        }
    }
}