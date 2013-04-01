<?php

class TypeclassRepo {
    private static $instances = array();

    public static function registerInstance($instance) {
        if(isset(self::$instances[$instance->getTypeclassName()])) {
            self::$instances[$instance->getTypeclassName()][$instance->getType()] = $instance;
        } else {
            self::$instances[$instance->getTypeclassName()] = array( $instance->getType() => $instance);
        }
    }

    public static function findInstance($typeclass, $type) {
        $type = gettype($type) !== "object" ? gettype($type) : get_class($type);

        return self::$instances[$typeclass][$type];
    }

}

interface Typeclass {
    public function getTypeclassName();
    public function getType();
}

class TypeclassWrapper {
    public function __construct($typeclass, $value) {
        $this->typeclass = $typeclass;
        $this->ev = TypeclassRepo::findInstance($typeclass, $value);
        $this->value = $value;
    }

    public function __call($name, $args) {
        $args[] = $this->value;
        return new TypeclassWrapper($this->typeclass, call_user_func_array(array($this->ev, $name), $args));
    }

    public function __toString() {
        return $this->value->_toString();
    }

    public function __invoke() {
        return $this->value;
    }
}
function __t($v, $tc) {
    return new TypeclassWrapper($tc, $v);
}
