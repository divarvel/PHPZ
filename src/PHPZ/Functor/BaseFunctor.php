<?php
namespace PHPZ\Functor;

use PHPZ\TypeClass\TypeClassInterface;

abstract class BaseFunctor implements TypeClassInterface
{
    public function getTypeclassName()
    {
        return 'Functor';
    }

    public function getMethods()
    {
        return array("map");
    }

    public abstract function map($function, $functor);
}

