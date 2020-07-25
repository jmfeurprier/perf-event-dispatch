<?php

namespace perf\EventDispatch;

use DomainException;

class Event implements EventInterface
{
    private string $id;

    /**
     * @var {string:mixed}
     */
    private array $parameters = [];

    /**
     * @param string         $id
     * @param {string:mixed} $parameters
     */
    public function __construct($id, array $parameters = [])
    {
        $this->id = $id;

        foreach ($parameters as $name => $value) {
            $this->addParameter($name, $value);
        }
    }

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @return void
     */
    private function addParameter(string $name, $value): void
    {
        $this->parameters[$name] = $value;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function hasParameter(string $name): bool
    {
        return array_key_exists($name, $this->parameters);
    }

    /**
     * @param string $name
     *
     * @return mixed
     *
     * @throws DomainException
     */
    public function getParameter(string $name)
    {
        if ($this->hasParameter($name)) {
            return $this->parameters[$name];
        }

        throw new DomainException("Parameter '{$name}' not found.");
    }
}
