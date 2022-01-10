<?php

namespace Phox\Nebula\Plasma\Implementation;

use Phox\Nebula\Atom\Implementation\Functions;
use Phox\Nebula\Atom\Notion\Interfaces\IDependencyInjection;
use Phox\Nebula\Atom\Notion\Interfaces\IEventManager;
use Phox\Nebula\Plasma\Implementation\Events\StarCompletedEvent;
use Phox\Nebula\Plasma\Implementation\Exceptions\StarActionException;
use Phox\Nebula\Plasma\Implementation\Exceptions\StarNotFoundException;

class StarHandler
{
    public StarCompletedEvent $eStarCompleted;

    public function __construct(
        protected IDependencyInjection $dependencyInjection,
        protected IEventManager $eventManager
    ) {
        $this->eStarCompleted = new StarCompletedEvent();
    }

    public function handle(StarResolver $resolver): void
    {
        $star = $resolver->getStar() ?? throw new StarNotFoundException();
        $action = $resolver->getAction();

        $this->dependencyInjection->singleton($star);

        $callback = is_null($action) ? $star : [$star, $action];

        if (!is_callable($callback)) {
            throw new StarActionException();
        }

        $resolver->setOutput($this->dependencyInjection->call($callback, $resolver->getParams()));

        $this->eventManager->notify($this->eStarCompleted);
    }
}