<?php

namespace Phox\Nebula\Plasma\Implementation;

use Phox\Nebula\Atom\Implementation\Application as AtomApplication;
use Phox\Nebula\Atom\Implementation\Exceptions\StateExistsException;
use Phox\Nebula\Plasma\Notion\Abstracts\Star;

class Application extends AtomApplication 
{
    protected ?Star $star = null;

    protected ?string $action = null;

	public function __construct()
	{
        try {
            call_user_func_array([$this, 'parent::__construct'], func_get_args());
        } catch (StateExistsException $e) {
            //
        }
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