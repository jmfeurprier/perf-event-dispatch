<?php

namespace perf\EventDispatch;

class EventDispatcher implements EventDispatcherInterface
{
    /**
     * Event listeners.
     *
     * @var {string:EventListenerInterface[]}
     */
    private $eventListeners = [];

    /**
     * @param {string:EventListenerInterface[]} $listeners
     */
    public function __construct(array $listeners = [])
    {
        foreach ($listeners as $eventId => $eventListeners) {
            foreach ($eventListeners as $listener) {
                $this->addListener($eventId, $listener);
            }
        }
    }

    private function addListener(string $eventId, EventListenerInterface $listener): void
    {
        $this->eventListeners[$eventId][] = $listener;
    }

    public function dispatch(EventInterface $event): void
    {
        $eventId = $event->getId();

        if (array_key_exists($eventId, $this->eventListeners)) {
            foreach ($this->eventListeners[$eventId] as $listener) {
                $listener->handle($event);
            }
        }
    }
}
