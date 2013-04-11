<?php
namespace PHPZ\Functor;

class MaybeFunctor extends BaseFunctor
{
    public function getType()
    {
        return 'Maybe';
    }

    public function map($callable, \PHPZ\Maybe $maybe)
    {
        return new Maybe(!$maybe->isEmpty() ? call_user_func($callable, array($maybe->get())) : null);
    }
}
