<?php
namespace PHPZ\Functor;

use PHPZ\Maybe;

class MaybeFunctor extends BaseFunctor
{
    public function getType()
    {
        return 'PHPZ\\Maybe';
    }

    public function map($callable, $maybe)
    {
        return new Maybe(!$maybe->isEmpty() ? call_user_func($callable, array($maybe->get())) : null);
    }
}
