<?php

namespace perf\EventDispatch;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class EventDispatcherTest extends TestCase
{
    /**
     * @var EventInterface|MockObject
     */
    private $event;

    private array $eventListeners = [];

    private EventDispatcher $eventDispatcher;

    protected function setUp(): void
    {
        $this->event = $this->createMock(EventInterface::class);
    }

    public function testDispatchWithoutListener()
    {
        $this->whenDispatch($this->event);

        $this->assertTrue(true);
    }

    public function testDispatchWithOneListenerExpectingEvent()
    {
        $eventId = 'foo';

        $this->event->expects($this->atLeastOnce())->method('getId')->willReturn($eventId);

        $eventListener = $this->createMock(EventListenerInterface::class);
        $eventListener->expects($this->once())->method('handle')->with($this->event);

        $this->givenEventListener($eventId, $eventListener);

        $this->whenDispatch($this->event);
    }

    public function testDispatchWithOneListenerExpectingOtherEvent()
    {
        $eventId      = 'foo';
        $otherEventId = 'bar';

        $this->event->expects($this->atLeastOnce())->method('getId')->willReturn($eventId);

        $eventListener = $this->createMock(EventListenerInterface::class);
        $eventListener->expects($this->never())->method('handle');

        $this->givenEventListener($otherEventId, $eventListener);

        $this->whenDispatch($this->event);
    }

    private function givenEventListener(string $eventId, EventListenerInterface $eventListener): void
    {
        $this->eventListeners[$eventId][] = $eventListener;
    }

    private function whenDispatch(EventInterface $event): void
    {
        $this->eventDispatcher = new EventDispatcher($this->eventListeners);

        $this->eventDispatcher->dispatch($event);
    }
}
