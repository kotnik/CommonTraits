<?php

trait Singleton {

    protected function __construct() {
        //Not allowed.
    }

    protected function __clone() {
        //Not allowed.
    }

    public static function getInstance(/* $arg1, $arg2, $argN */) {
        static $instance;

        if (null === $instance) {
            $class = new ReflectionClass(__CLASS__);

            $instance = $class->newInstanceWithoutConstructor();

            $constructor = $class->getConstructor();
            $constructor->setAccessible(true);
            $constructor->invokeArgs($instance, func_get_args());
        }

        return $instance;
    }

}

