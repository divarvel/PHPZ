<?php
namespace PHPZ\Monoid;

class StringMonoid extends BaseMonoid 
{
    public function getType() 
    {
        return 'string';
    }

    public function mappend($a2, $a1) 
    {
        return $a1.$a2;
    }

    public function mzero() 
    {
        return '';
    }
}
