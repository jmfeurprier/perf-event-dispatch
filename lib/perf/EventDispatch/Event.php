<?php

namespace perf\EventDispatch;

/**
 *
 *
 */
class Event
{

    /**
     * Event identifier.
     *
     * @var string
     */
    private $id;

    /**
     * Parameters.
     *
     * @var {string:mixed}
     */
    private $parameters = array();

    /**
     * Constructor.
     *
     * @param string $id
     * @param {string:mixed} $parameters
     * @return void
     */
    public function __construct($id, array $parameters = array())
    {
        $this->id         = $id;
        $this->parameters = $parameters;
    }

    /**
     *
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     *
     * @param string $name
     * @return mixed
     * @throws \DomainException
     */
    public function hasParameter($name)
    {
        return array_key_exists($name, $this->parameters);
    }

    /**
     *
     *
     * @param string $name
     * @return mixed
     * @throws \DomainException
     */
    public function getParameter($name)
    {
        if (array_key_exists($name, $this->parameters)) {
            return $this->parameters[$name];
        }

        throw new \DomainException("Parameter '{$name}' not found.");
    }
}
