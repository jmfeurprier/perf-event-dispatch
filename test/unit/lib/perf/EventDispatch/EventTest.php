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

    /**
     *
     */
    public function testHasParameterWithNotExistingParameter()
    {
        $id = 'foo.bar';

        $event = new Event($id);

        $this->assertFalse($event->hasParameter('baz'));
    }

    /**
     *
     */
    public function testHasParameterWithExistingParameter()
    {
        $id = 'foo.bar';
        $parameters = array(
            'baz' => 'qux',
        );

        $event = new Event($id, $parameters);

        $this->assertTrue($event->hasParameter('baz'));
    }

    /**
     *
     * @expectedException \DomainException
     */
    public function testGetParameterWithNotExistingParameter()
    {
        $id = 'foo.bar';

        $event = new Event($id);

        $event->getParameter('baz');
    }

    /**
     *
     */
    public function testGetParameterWithExistingParameter()
    {
        $id = 'foo.bar';
        $parameters = array(
            'baz' => 'qux',
        );

        $event = new Event($id, $parameters);

        $this->assertSame('qux', $event->getParameter('baz'));
    }
}
