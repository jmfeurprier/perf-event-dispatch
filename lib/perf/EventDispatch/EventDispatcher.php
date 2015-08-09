<?php

namespace perf\EventDispatch;

/**
 *
 *
 */
class EventDispatcher
{

    /**
     * Event listeners.
     *
     * @var {string:EventListener[]}
     */
    private $listeners = array();

    /**
     *
     *
     * @param string $eventId
     * @param EventListener $listener
     * @return void
     */
    public function addListener($eventId, EventListener $listener)
    {
        $this->listeners[$eventId][] = $listener;
    }

    /**
     *
     *
     * @param Event $event
     * @return void
     */
    public function dispatch(Event $event)
    {
        $eventId = $event->getId();

        if (array_key_exists($eventId, $this->listeners)) {
            foreach ($this->listeners[$eventId] as $listener) {
                $listener->handle($event);
            }
        }
    }
}
