<?php

namespace Phox\Nebula\Plasma\Implementation\Events;

use Phox\Nebula\Atom\Implementation\Event\Event;
use Phox\Nebula\Plasma\Notion\IActionResult;

class ActionCompletedEvent extends Event
{
    public function __construct(
        public readonly IActionResult $actionResult,
    ) {
    }
}