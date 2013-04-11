<?php
namespace PHPZ\Monad;

use \PHPZ\TypeClass\TypeClassInterface;

abstract class BaseMonad implements TypeClassInterface
{
    public function getTypeclassName()
    {
        return 'Monad';
    }

    public function getMethods()
    {
        return array("pure", "bind");
    }

    public abstract function pure($value);

    public abstract function bind($f, BaseMonad $ma);

    public function join(BaseMonad $ma, BaseMonad $mb)
    {
        $this->join($ma, function($x) { return $mb; });
    }
}
