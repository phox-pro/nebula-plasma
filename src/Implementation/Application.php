<?php

namespace Phox\Nebula\Plasma\Implementation;

use Phox\Nebula\Atom\Implementation\Application as AtomApplication;
use Phox\Nebula\Atom\Implementation\Basics\Collection;
use Phox\Nebula\Atom\Implementation\Exceptions\StateExistsException;
use Phox\Nebula\Atom\Notion\Interfaces\IStateContainer;
use Phox\Nebula\Plasma\Notion\Abstracts\Star;

class Application extends AtomApplication 
{
    protected ?Star $star = null;

    protected ?string $action = null;

	public function __construct(Collection $providers)
	{
        $this->providers = $providers;
    }
    
    public function setStar(Star $star)
    {
        $this->star = $star;
    }

    public function getStar() : ?Star
    {
        return $this->star;
    }

    public function setAction(?string $action = null)
    {
        $this->action = $action;
    }

    public function getAction() : ?string
    {
        return $this->action;
    }
}