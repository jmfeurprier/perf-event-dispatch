<?php

namespace perf\EventDispatch;

/**
 *
 */
class EventTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    public function testGetId()
    {
        $id = 'foo.bar';

        $event = new Event($id);

        $this->assertSame($id, $event->getId());
    }
}
