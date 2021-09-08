<?php

namespace Phox\Nebula\Plasma\Implementation;

use Phox\Nebula\Atom\Implementation\Functions;
use Phox\Nebula\Plasma\Implementation\Events\StarCompletedEvent;
use Phox\Nebula\Plasma\Implementation\Exceptions\StarActionException;
use Phox\Nebula\Plasma\Implementation\Exceptions\StarNotFoundException;

class StarHandler
{
    public StarCompletedEvent $eStarCompleted;

    public function __construct()
    {
        $this->eStarCompleted = new StarCompletedEvent();
    }

    public function handle(StarResolver $resolver): void
    {
        $container = Functions::container();

        $star = $resolver->getStar() ?? throw new StarNotFoundException();
        $action = $resolver->getAction();

        $container->singleton($star);

        $callback = is_null($action) ? $star : [$star, $action];

        if (!is_callable($callback)) {
            throw new StarActionException();
        }

        $resolver->setOutput($container->call($callback, $resolver->getParams()));

        $this->eStarCompleted->notify();
    }

    public function render(StarResolver $resolver): void
    {
        $output = $resolver->getOutput();

        $result = (string)$output;

        echo $result;
    }
}