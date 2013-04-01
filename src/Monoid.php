<?php

abstract class Monoid implements Typeclass {
    public function getTypeclassName() {
        return 'Monoid';
    }
    public function getMethods() {
        return array("mappend", "mzero","mconcat");
    }
    public abstract function mappend($a2, $a1);
    public abstract function mzero();
    public function mconcat($elements) {
        $acc = $this->mzero();
        foreach($elements as $e) {
            $acc = $this->mappend($acc, $e);
        }
        return $acc;
    }
}

class StringMonoid extends Monoid {
    public function getType() {
        return 'string';
    }
    public function mappend($a2, $a1) {
        return $a1.$a2;
    }
    public function mzero() {
        return '';
    }
}

TypeclassRepo::registerInstance(new StringMonoid());

class ArrayMonoid extends Monoid {
    public function getType() {
        return 'array';
    }
    public function mappend($a2, $a1) {
        return array_merge($a1,$a2);
    }
    public function mzero() {
        return '';
    }
}

TypeclassRepo::registerInstance(new ArrayMonoid());

class MaybeMonoid extends Monoid {
    public function getType() {
        return 'Maybe';
    }
    public function mappend($a2, $a1) {
        $innerMonoid = null;
        if(!$a1->isEmpty() && !$a2->isEmpty()) {
            $innerMonoid = TypeclassRepo::findInstance('Monoid', $a1->get());
            return new Maybe($innerMonoid->mappend($a1->get(), $a2->get()));
        } else if(!$a1->isEmpty()) {
            return $a1;
        } else if(!$a2->isEmpty()) {
            return $a2;
        } else {
            return new Monoid(null);
        }
    }
    public function mzero() {
        return '';
    }
}

TypeclassRepo::registerInstance(new MaybeMonoid());

