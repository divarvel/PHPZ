<?php
namespace PHPZ\TypeClass;

use \PHPZ\TypeClass\TypeclassRepo as Repo;

class TypeClassWrapper
{
    static public function wrap($value)
    {
        return new TypeClassWrapper($value);
    }

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function __call($name, $args)
    {
        $ev = Repo::findInstance(Repo::findTypeClass($name), $this->value);
        $args[] = $this->value;

        return new TypeClassWrapper(call_user_func_array(array($ev, $name), $args));
    }

    public function __toString()
    {
        return $this->value->_toString();
    }

    public function __invoke()
    {
        return $this->value;
    }
}
