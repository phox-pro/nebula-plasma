<?php

namespace Phox\Nebula\Plasma\Implementation\Exceptions;

use Exception;
use Phox\Nebula\Plasma\Notion\Abstracts\Star;

class StarNotSetted extends Exception 
{
	public function __construct()
	{
        parent::__construct('Executable class typed "' . Star::class . '" not set');
	}
}