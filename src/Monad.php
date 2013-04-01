<?php

abstract class Monad implements Typeclass {
    public function getTypeclassName() {
        return 'Monad';
    }
    public abstract function pure($value);

    public abstract function bind($ma, $f);

    public function join($ma, $mb) {
        $this->join($ma, function($x) { return $mb; });
    }
}


class ArrayMonad extends Monad {
    public function getType() {
        return 'array';
    }

    public function pure($value) {
        return array($value);
    }

    public function bind($ma, $f) {
        $mb = array();
        $fma = __t($ma, 'Functor')->map($f, $ma);

        foreach($fma as $v) {
            foreach($v as $vv) {
                $mb[] = $vv;
            }
        }

        return $mb;
    }
}

TypeclassRepo::registerInstance(new ArrayMonad());

class MaybeMonad extends Functor {
    public function getType() {
        return 'Maybe';
    }

    public function pure($value) {
        return new Maybe($value);
    }

    public function bind($ma, $f) {
        $fma = __t($ma, 'Functor')->map($f, $ma);

        return (!$fma->isEmpty) ? $fma.get() : $fma; 
    }
}

TypeclassRepo::registerInstance(new MaybeMonad());
