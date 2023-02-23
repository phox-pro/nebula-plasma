<?php

namespace Phox\Nebula\Plasma\Notion;

interface IActionResolver
{
    public function setAction(?IAction $action = null): ?IAction;

    public function getAction(): ?IAction;
}