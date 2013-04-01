<?php

abstract class Functor implements Typeclass {
    public function getTypeclassName() {
        return 'Functor';
    }
    public abstract function map($function, $functor);
}

class ArrayFunctor extends Functor {
    public function getType() {
        return 'array';
    }

    public function map($function, $array) {
        return array_map($function, $array);
    }
}

TypeclassRepo::registerInstance(new ArrayFunctor());

class MaybeFunctor extends Functor {
    public function getType() {
        return 'Maybe';
    }

    public function map($function, $maybe) {
            return new Maybe($function($maybe->get()));
    }
}

TypeclassRepo::registerInstance(new MaybeFunctor());
