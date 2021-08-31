<?php

namespace Phox\Nebula\Plasma\Implementation;

use Phox\Nebula\Plasma\Notion\Abstracts\Star;

class StarResolver
{
    private ?Star $star = null;
    private ?string $action = null;
    private mixed $output = null;

    public function getStar(): ?Star
    {
        return $this->star;
    }

    public function setStar(Star $star): void
    {
        $this->star = $star;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function setAction(?string $action): void
    {
        $this->action = $action;
    }

    public function getOutput(): mixed
    {
        return $this->output;
    }

    public function setOutput(mixed $output): void
    {
        $this->output = $output;
    }
}