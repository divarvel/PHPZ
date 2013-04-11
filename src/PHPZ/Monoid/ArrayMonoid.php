<?php
namespace PHPZ\Monoid;

class ArrayMonoid extends BaseMonoid 
{
    public function getType() 
    {
        return 'array';
    }

    public function mappend($a2, $a1) 
    {
        return array_merge($a1,$a2);
    }

    public function mzero() 
    {
        return '';
    }
}
