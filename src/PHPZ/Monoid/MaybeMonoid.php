<?php
namespace PHPZ\Monoid;

class MaybeMonoid extends BaseMonoid 
{
    public function getType() 
    {
        return 'Maybe';
    }

    public function mappend($a2, $a1) 
    {
        $innerMonoid = null;

        if(!$a1->isEmpty() && !$a2->isEmpty()) {
            $innerMonoid = TypeclassRepo::findInstance('Monoid', $a1->get());

            return new Maybe($innerMonoid->mappend($a1->get(), $a2->get()));
        } else if(!$a1->isEmpty()) {
            return $a1;
        } else if(!$a2->isEmpty()) {
            return $a2;
        } else {
            return new Maybe(null);
        }
    }
    public function mzero() 
    {
        return '';
    }
}


