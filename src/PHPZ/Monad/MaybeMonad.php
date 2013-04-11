<?php
namespace PHPZ\Monad;

use \PHPZ\TypeClass\TypeClassWrapper;
use \PHPZ\Maybe;

class MaybeMonad extends BaseMonad 
{
    public function getType() 
    {
        return 'PHPZ\Maybe';
    }

    public function pure($value) {
        return new Maybe($value);
    }

    public function bind($f, $ma) {
        $fma = TypeClassWrapper::wrap($ma)->map($f);
        $fma = $fma();

        return (!$fma->isEmpty()) ? $fma->get() : $fma; 
    }
}


