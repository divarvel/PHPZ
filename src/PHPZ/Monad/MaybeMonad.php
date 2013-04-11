<?php
namespace PHPZ\Monad;

use \PHPZ\TypeClass\TypeClassWrapper;

class MaybeMonad extends BaseMonad {
    public function getType() {
        return 'Maybe';
    }

    public function pure($value) {
        return new Maybe($value);
    }

    public function bind($f, BaseMonad $ma) {
        $fma = TypeClassWrapper($ma)->map($f);
        $fma = $fma();

        return (!$fma->isEmpty()) ? $fma->get() : $fma; 
    }
}


