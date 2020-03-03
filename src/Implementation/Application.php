<?php

namespace Phox\Nebula\Plasma\Implementation;

use Phox\Nebula\Atom\Implementation\Application as AtomApplication;
use Phox\Nebula\Atom\Implementation\Exceptions\StateExistsException;

class Application extends AtomApplication 
{
	public function __construct()
	{
        try {
            call_user_func_array([$this, 'parent::__construct'], func_get_args());
        } catch (StateExistsException $e) {
            //
        }
	}
}