<?php
namespace PHPZ\Monad;

use \PHPZ\TypeClassWrapper;

class ArrayMonad extends BaseMonad
{
    public function getType()
    {
        return 'array';
    }

    public function pure($value)
    {
        return array($value);
    }

    public function bind($f, BaseMonad $ma)
    {
        $mb = array();
        $fma = TypeClassWrapper::wrap($ma)->map($f);

        foreach($fma() as $v) {
            foreach($v as $vv) {
                $mb[] = $vv;
            }
        }

        return $mb;
    }
}
