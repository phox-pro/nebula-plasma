<?php

use Phox\Nebula\Atom\Notion\INebulaConfig;
use Phox\Nebula\Atom\Notion\IProvider;
use Phox\Nebula\Plasma\PlasmaProvider;

return new class implements INebulaConfig {

    public function getProvider(): ?IProvider
    {
        return new PlasmaProvider();
    }
};