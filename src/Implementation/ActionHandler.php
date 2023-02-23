<?php

namespace Phox\Nebula\Plasma\Implementation;

use Phox\Nebula\Atom\Implementation\Services\ServiceContainerAccess;
use Phox\Nebula\Plasma\Implementation\Events\ActionCompletedEvent;
use Phox\Nebula\Plasma\Notion\IActionHandler;
use Phox\Nebula\Plasma\Notion\IActionResolver;

class ActionHandler implements IActionHandler
{
    use ServiceContainerAccess;

    public function handle(): void
    {
        $resolver = $this->container()->get(IActionResolver::class);
        $action = $resolver->getAction();

        if (is_null($action)) {
            return;
        }

        $result = $action->run();

        (new ActionCompletedEvent($result))->notify();

        echo (string)$result;
    }
}