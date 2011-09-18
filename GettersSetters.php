<?php

trait GettersSetters {

    protected function tableize($property) {
        return preg_replace_callback('/[A-Z]/', function ($char) {
            return '_' . $char;
        }, $property);
    }

    public function __call($method, $args) {
        $property = $this->tableize(substr($method, 3));
        switch (substr($method, 0, 3)) {
            case 'get':
                return isset($this->$property) ? $this->$property : null;
            case 'set':
                return $this->$property = isset($args[0]) ? $args[0] : null;
            case 'has':
                return isset($this->$property);
        }
    }

}
