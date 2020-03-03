<?php

namespace Phox\Nebula\Plasma;

use Phox\Nebula\Atom\TestCase as AtomTestCase;
use Phox\Nebula\Plasma\Implementation\Application;
use Phox\Nebula\Atom\Implementation\Application as AtomApplication;
use Phox\Nebula\Atom\Implementation\StateContainer;

class TestCase extends AtomTestCase 
{
    protected function setUp(): void
    {
        parent::setUp();
        make(Application::class);
    }
}