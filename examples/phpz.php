<?php

include dirname(__DIR__)."/vendor/autoload.php";

use \PHPZ\Maybe;
use \PHPZ\TypeClass\TypeClassWrapper;

\PHPZ\PHPZ::init();

function __t($ma)
{
    return new TypeClassWrapper($ma);
}

$ma = new Maybe("test");

$mb = __t($ma)->map(function($x) { return strlen($x); })
              ->map(function($x) { return $x + 5 ; });

print $mb();
print "\n";
exit;

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
