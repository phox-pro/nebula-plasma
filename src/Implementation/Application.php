<?php

namespace Phox\Nebula\Plasma\Implementation;

use Phox\Nebula\Atom\Implementation\Application as AtomApplication;
use Phox\Nebula\Atom\Implementation\Basics\Collection;
use Phox\Nebula\Plasma\Implementation\Events\StarEvent;
use Phox\Nebula\Plasma\Implementation\Exceptions\StarNotSetted;
use Phox\Nebula\Plasma\Notion\Abstracts\Star;

class Application extends AtomApplication 
{
    protected ?Star $star = null;

    protected ?string $action = null;

    protected ?string $output = null;

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

    public function getOutput() : ?string
    {
        return $this->output;
    }

    protected function enrichment()
    {
        parent::enrichment();
        isset($this->star)
            ? $this->output = call(is_null($this->action) ? $this->star : [$this->star, $this->action])
            : error(StarNotSetted::class);
        StarEvent::notify($this->star);
        echo $this->output;
    }
}