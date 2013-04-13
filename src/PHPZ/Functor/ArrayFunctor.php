<?php
namespace PHPZ\Functor;

class ArrayFunctor extends BaseFunctor {
    public function getType() {
        return 'array';
    }

    public function map($function, $array) {
        return array_map($function, $array);
    }
}


