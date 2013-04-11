<?php
namespace PHPZ\TypeClass;

use \PHPZ\TypeClass\TypeClassInterface;

class TypeClassRepo
{
    private static $instances = array();

    public static function registerInstance(TypeClassInterface $instance)
    {
        if(isset(self::$instances[$instance->getTypeclassName()])) {
            self::$instances[$instance->getTypeclassName()]["instances"][$instance->getType()] = $instance;
        } else {
            self::$instances[$instance->getTypeclassName()] = array(
                "instances" => array($instance->getType() => $instance),
                "methods" => $instance->getMethods()
            );
        }
    }

    public static function findInstance($typeClass, $type)
    {
        $type = gettype($type) !== "object" ? gettype($type) : get_class($type);

        if (!isset(self::$instances[$typeClass]['instances'][$type])) {
            throw new \Exception(sprintf("Repo does not know instance of '%s' with type '%s'.\nI know {%s}.\n", $typeClass, $type, print_r(self::$instances, true)));
        }

        return self::$instances[$typeClass]["instances"][$type];
    }

    public static function findTypeClass($methodName)
    {
        foreach(self::$instances as $k => $v) {
            if(in_array($methodName, $v["methods"])) {

                return $k;
            }
        }
    }
}
