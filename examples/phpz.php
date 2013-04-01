<?php

include "src/TypeClass.php";
include "src/Maybe.php";
include "src/Monoid.php";
include "src/Functor.php";


$ma = new Maybe("test");


$mb = __t($ma, 'Functor')->map(function($x) { return strlen($x); })
                       ->map(function($x) { return $x + 5 ; });

print $mb();

$as = array("foo", "bar", "qix");

$bs = __t($as, 'Functor')->map(function($x) { return strlen($x); })
                         ->map(function($x) { return $x + 5 ; });

print_r($bs());
