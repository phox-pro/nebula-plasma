<?php

namespace Phox\Nebula\Plasma;

use Phox\Nebula\Atom\TestCase as AtomTestCase;

class TestCase extends AtomTestCase 
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->nebula->addProvider(new PlasmaProvider());
    }
}