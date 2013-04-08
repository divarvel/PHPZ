<?php

abstract class Monad implements Typeclass {
    public function getTypeclassName() {
        return 'Monad';
    }
    public function getMethods() {
        return array("pure", "bind");
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

    public function bind($f, $ma) {
        $mb = array();
        $fma = __t($ma)->map($f);
        $fma = $fma();

        foreach($fma as $v) {
            foreach($v as $vv) {
                $mb[] = $vv;
            }
        }

        return $mb;
    }
}

TypeclassRepo::registerInstance(new ArrayMonad());

class MaybeMonad extends Monad {
    public function getType() {
        return 'Maybe';
    }

    public function pure($value) {
        return new Maybe($value);
    }

    public function bind($f, $ma) {
        $fma = __t($ma)->map($f);
        $fma = $fma();

        return (!$fma->isEmpty()) ? $fma->get() : $fma; 
    }
}

TypeclassRepo::registerInstance(new MaybeMonad());
