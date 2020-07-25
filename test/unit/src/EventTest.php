<?php

namespace perf\EventDispatch;

use DomainException;
use PHPUnit\Framework\TestCase;

class EventTest extends TestCase
{
    public function testGetId()
    {
        $id = 'foo.bar';

        $event = new Event($id);

        $this->assertSame($id, $event->getId());
    }

    public function testHasParameterWithNotExistingParameter()
    {
        $id = 'foo.bar';

        $event = new Event($id);

        $this->assertFalse($event->hasParameter('baz'));
    }

    public function testHasParameterWithExistingParameter()
    {
        $id         = 'foo.bar';
        $parameters = [
            'baz' => 'qux',
        ];

        $event = new Event($id, $parameters);

        $this->assertTrue($event->hasParameter('baz'));
    }

    public function testGetParameterWithNotExistingParameter()
    {
        $id = 'foo.bar';

        $event = new Event($id);

        $this->expectException(DomainException::class);

        $event->getParameter('baz');
    }

    public function testGetParameterWithExistingParameter()
    {
        $id         = 'foo.bar';
        $parameters = [
            'baz' => 'qux',
        ];

        $event = new Event($id, $parameters);

        $this->assertSame('qux', $event->getParameter('baz'));
    }
}
