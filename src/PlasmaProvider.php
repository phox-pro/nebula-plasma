<?php

namespace Phox\Nebula\Plasma;

use Phox\Nebula\Atom\Implementation\Application;
use Phox\Nebula\Atom\Notion\Abstracts\Provider;
use Phox\Nebula\Atom\Notion\Interfaces\IDependencyInjection;
use Phox\Nebula\Plasma\Implementation\Application as ImplementationApplication;

class PlasmaProvider extends Provider 
{
    public function define(IDependencyInjection $container, Application $application)
    {
        $plasmaApplication = make(ImplementationApplication::class, [$application->getProviders()]);
        $container->singleton($plasmaApplication);
        $container->singleton($plasmaApplication, Application::class);
    }
}