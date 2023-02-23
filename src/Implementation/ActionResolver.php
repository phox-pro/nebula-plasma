<?php

namespace Phox\Nebula\Plasma\Implementation;

use Phox\Nebula\Plasma\Notion\IAction;
use Phox\Nebula\Plasma\Notion\IActionResolver;

class ActionResolver implements IActionResolver
{
    protected ?IAction $action = null;

    public function setAction(?IAction $action = null): ?IAction
    {
        $oldAction = $this->action;

        $this->action = $action;

        return $oldAction;
    }

    public function getAction(): ?IAction
    {
        return $this->action;
    }
}