<?php

include "src/TypeClass.php";
include "src/Maybe.php";
include "src/Monoid.php";
include "src/Functor.php";
include "src/Monad.php";


$ma = new Maybe("test");


$mb = __t($ma)->map(function($x) { return strlen($x); })
              ->map(function($x) { return $x + 5 ; });

print $mb();
print "\n";

$as = array("foo", "foobar", "foobarqix");

$bs = __t($as)->map(function($x) { return strlen($x); })
                         ->map(function($x) { return $x + 5 ; });

print_r($bs());
print "\n";

function lookup($i) {
    $map = array(
        "foo" => 3,
        "bar" => 4
    );

    return new Maybe($map[$i]);
}

$mc = new Maybe("foo");

$md = __t($mc)->bind(function($x) { return lookup($x); });

print_r($md()->getOrElse("not found")."\n");

$cs = array("foo", "foobar", "foobarqix");

$ds = __t($as)->map(function($x) { return strlen($x); })
              ->bind(function($x) { return array($x - 5, $x, $x + 5) ; });

print_r($ds());
