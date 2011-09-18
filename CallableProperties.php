<?php

trait CallableProperties {

    public function __call($property, $args) {
        if (!isset($this->$property) || !is_callable($this->$property)) {
            $message = __CLASS__ . '::' . $property . ' is not callable.';
            throw new BadMethodCallException($message);
        }
        return call_user_func_array($this->$property, $args);
    }

    public static function __callStatic($property, $args) {
        if (!isset(static::$property) || !is_callable(static::$property)) {
            $message = __CLASS__ . '::' . $property . ' is not callable.';
            throw new BadMethodCallException($message);
        }
        return forward_static_call_array(static::$property, $args);
    }

}

