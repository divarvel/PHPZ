<?php
namespace PHPZ;

use \PHPZ\TypeClass\TypeClassRepo;
use \PHPZ\Functor\ArrayFunctor;
use \PHPZ\Functor\MaybeFunctor;
use \PHPZ\Monad\ArrayMonad;
use \PHPZ\Monad\MaybeMonad;
use \PHPZ\Monoid\StringMonoid;
use \PHPZ\Monoid\ArrayMonoid;
use \PHPZ\Monoid\MaybeMonoid;

class PHPZ
{
    static public function init()
    {
        TypeClassRepo::registerInstance(new ArrayFunctor());
        TypeclassRepo::registerInstance(new ArrayMonad());
        TypeclassRepo::registerInstance(new MaybeMonad());
        TypeclassRepo::registerInstance(new StringMonoid());
        TypeclassRepo::registerInstance(new ArrayMonoid());
        TypeclassRepo::registerInstance(new MaybeMonoid());
    }
}
