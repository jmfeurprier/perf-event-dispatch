<?php

namespace perf\EventDispatch;

/**
 *
 */
class EventDispatcherTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    protected function setUp()
    {
        $this->eventDispatcher = new EventDispatcher();

        $this->event = $this->getMockBuilder(__NAMESPACE__ . '\\Event')->disableOriginalConstructor()->getMock();
    }

    /**
     *
     */
    public function testDispatchWithoutListener()
    {
        $this->eventDispatcher->dispatch($this->event);
    }

    /**
     *
     */
    public function testDispatchWithOneListenerExpectingEvent()
    {
        $eventId = 'foo';

        $this->event->expects($this->atLeastOnce())->method('getId')->willReturn($eventId);

        $eventListener = $this->getMock(__NAMESPACE__ . '\\EventListener');
        $eventListener->expects($this->once())->method('handle')->with($this->event);

        $this->eventDispatcher->addListener($eventId, $eventListener);

        $this->eventDispatcher->dispatch($this->event);
    }

    /**
     *
     */
    public function testDispatchWithOneListenerExpectingOtherEvent()
    {
        $eventId      = 'foo';
        $otherEventId = 'bar';

        $this->event->expects($this->atLeastOnce())->method('getId')->willReturn($eventId);

        $eventListener = $this->getMock(__NAMESPACE__ . '\\EventListener');
        $eventListener->expects($this->never())->method('handle');

        $this->eventDispatcher->addListener($otherEventId, $eventListener);

        $this->eventDispatcher->dispatch($this->event);
    }
}
