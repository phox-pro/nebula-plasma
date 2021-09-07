<?php

namespace Phox\Nebula\Plasma;

use Phox\Nebula\Atom\Implementation\ProvidersContainer;
use Phox\Nebula\Atom\TestCase as AtomTestCase;

class TestCase extends AtomTestCase 
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->container()->get(ProvidersContainer::class)
            ->addProvider(new PlasmaProvider());
    }
}