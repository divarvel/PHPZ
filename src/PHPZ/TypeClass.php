<?php
namespace PHPZ;

class TypeclassRepo {
    private static $instances = array();

    public static function registerInstance($instance) {
        if(isset(self::$instances[$instance->getTypeclassName()])) {
            self::$instances[$instance->getTypeclassName()]["instances"][$instance->getType()] = $instance;
        } else {
            self::$instances[$instance->getTypeclassName()] = array(
                "instances" => array($instance->getType() => $instance),
                "methods" => $instance->getMethods()
            );
        }
    }

    public static function findInstance($typeclass, $type) {
        $type = gettype($type) !== "object" ? gettype($type) : get_class($type);

        return self::$instances[$typeclass]["instances"][$type];
    }

    public static function findTypeClass($method_name) {
        foreach(self::$instances as $k => $v) {
            if(in_array($method_name, $v["methods"])) {
                return $k;
            }
        }
    }

}

interface Typeclass {
    public function getTypeclassName();
    public function getType();
}

class TypeclassWrapper {
    public function __construct($value) {
        $this->value = $value;
    }

    public function __call($name, $args) {
        $tc = TypeclassRepo::findTypeClass($name);
        $ev = TypeclassRepo::findInstance($tc, $this->value);
        $args[] = $this->value;
        return new TypeclassWrapper(call_user_func_array(array($ev, $name), $args));
    }

    public function __toString() {
        return $this->value->_toString();
    }

    public function __invoke() {
        return $this->value;
    }
}
function __t($v) {
    return new TypeclassWrapper($v);
}
