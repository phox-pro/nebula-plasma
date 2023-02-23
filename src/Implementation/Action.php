<?php

namespace Phox\Nebula\Plasma\Implementation;

use Phox\Nebula\Atom\Implementation\Services\ServiceContainerAccess;
use Phox\Nebula\Plasma\Implementation\ActionResults\StringActionResult;
use Phox\Nebula\Plasma\Notion\IAction;
use Phox\Nebula\Plasma\Notion\IActionResult;

abstract class Action implements IAction
{
    use ServiceContainerAccess;

    public function string(string $data): StringActionResult
    {
        return new StringActionResult($data);
    }
}