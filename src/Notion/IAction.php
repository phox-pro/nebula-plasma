<?php

namespace Phox\Nebula\Plasma\Notion;

interface IAction
{
    public function run(): IActionResult;
}