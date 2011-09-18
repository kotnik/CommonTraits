<?php

trait MethodClosures {

    public function callParent($method, $args) {
        return call_user_func_array("parent::$method", $args);
    }

    public function getParentClosure($method) {
        $self = $this;
        return function () use ($self, $method) {
            return $self->callParent($method, func_get_args());
        };
    }

    public function getMethodClosure($method) {
        if ($method === '__construct') {
            return $this->getConstructorClosure();
        }
        $method = array($this, $method);
        return function () use ($method) {
            return call_user_func_array($method, func_get_args());
        };
    }

    public function getConstructorClosure() {
        $class = new ReflectionClass(__CLASS__);
        return function () use ($class) {
            return $class->newInstanceArgs(func_get_args());
        };
    }

}

