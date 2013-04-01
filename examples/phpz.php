<?php

include "src/TypeClass.php";
include "src/Maybe.php";
include "src/Monoid.php";
include "src/Functor.php";


$a = new Maybe("test");


$b = __t($a, 'Functor')->map(function($x) { return strlen($x); })->map(function($x) { return $x + 5 ; });

print $b();
