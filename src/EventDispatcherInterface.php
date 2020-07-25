<?php

namespace perf\EventDispatch;

interface EventDispatcherInterface
{
    public function dispatch(EventInterface $event): void;
}
