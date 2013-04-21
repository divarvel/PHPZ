PHPz
====

How to set up
-------------

In the .composer.json directory, just invoke `composer.phar install` and you'll get the `vendor/autoloader.php` you need.

The what
--------

PHPz brings the power power and expressiveness of functional programming to
the PHP masses. It is heavily inspired from scalaz, which also brings
functional constructs to an otherwise imperative language.

Like scalaz, PHPz uses the typeclass pattern to bind new behaviour to existing
constructs.

Since PHP does not have a proper type system, PHPz needs some help to
successfully get the needed typeclass instance.

A simple wrapper is provided:

    $a = array("foo", "foobar", "foobarqix");


    // __t($a) wraps around $a and adds typeclass behaviour
    $b = __t($a)->map(function($x) { return strlen($x); })
                ->map(function($x) { return $x + 5; });

    // You need to call the wrapped value with no args to unwrap it.
    print_r($b()); // array(8, 11, 14)

    $cs = array("foo", "foobar", "foobarqix");

    $ds = __t($as)->map(function($x) { return strlen($x); })
                  ->bind(function($x) { return array($x - 5, $x, $x + 5) ; });
    print_r($ds()); // array(-2,3,8,1,6,11,4,9,14)

Try it for yourself !

    $ php -f examples/phpz.php
