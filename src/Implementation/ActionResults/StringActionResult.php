<?php

namespace Phox\Nebula\Plasma\Implementation\ActionResults;

use Phox\Nebula\Plasma\Notion\IActionResult;

class StringActionResult implements IActionResult
{
    public function __construct(
        protected string $data,
    ) {

    }

    public function __toString()
    {
        return $this->data;
    }
}