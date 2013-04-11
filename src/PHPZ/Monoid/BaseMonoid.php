<?php
namespace PHPZ\Monoid;

use \PHPZ\Typeclass\TypeClassInterface;

abstract class BaseMonoid implements TypeClassInterface
{
    public function getTypeclassName()
    {
        return 'Monoid';
    }

    public function getMethods()
    {
        return array("mappend", "mzero","mconcat");
    }

    public abstract function mappend($a2, $a1);

    public abstract function mzero();

    public function mconcat($elements)
    {
        $acc = $this->mzero();

        foreach($elements as $e) {
            $acc = $this->mappend($acc, $e);
        }

        return $acc;
    }
}


