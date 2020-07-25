<?php

namespace perf\EventDispatch;

use DomainException;

interface EventInterface
{
    public function getId(): string;

    public function hasParameter(string $name): bool;

    /**
     * @param string $name
     *
     * @return mixed
     *
     * @throws DomainException
     */
    public function getParameter(string $name);
}
