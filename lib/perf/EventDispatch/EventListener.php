<?php

namespace perf\EventDispatch;

/**
 *
 *
 */
interface EventListener
{

    /**
     *
     *
     * @param Event $event
     * @return void
     */
    public function handle(Event $event);
}
