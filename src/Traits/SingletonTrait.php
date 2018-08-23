<?php

namespace DigitaleHelden\Toolkit\Traits;

/**
 * Trait Singleton
 * @package DigitaleHelden\Toolkit\Traits
 */
trait SingletonTrait
{
    /**
     * @var null|$this
     */
    protected static $_instance = null;


    /**
     * Create/retrieve instance
     *
     * @param mixed ...$args
     * @return $this
     */
    final public static function getInstance(...$args)
    {
        if(static::$_instance === null)
        {
            static::$_instance = new static($args);
        }
        return static::$_instance;
    }


    /**
     * check if singleton has been created already
     *
     * @return bool
     */
    final public static function hasInstance()
    {
        return (static::$_instance) ? true : false;
    }


    /**
     * Constructor is private so class the uses trait will be initialized with $this::init
     *
     * @param mixed ...$args
     */
    final private function __construct(...$args)
    {
        $this->init($args);
    }


    /**
     * Class that uses this trait should implement this function
     *
     * @param mixed ...$args
     */
    protected function init(...$args) {}


    /**
     * deny serialization
     */
    final private function __wakeup() {}


    /**
     * deny cloning
     */
    final private function __clone() {}
}
