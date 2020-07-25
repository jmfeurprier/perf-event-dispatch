<?php

namespace perf\EventDispatch;

interface EventListenerInterface
{
    public function handle(EventInterface $event): void;
}
