<?php

require dirname(__DIR__)."/autoload.php";
require dirname(__DIR__)."/lime.php";

class MaybeTest extends lime_test
{
    public function testMaybe()
    {
        $maybe = new \PHPZ\Maybe();
        $this->is('Nothing', (string) $maybe, 'No value means empty maybe.');
        $this->ok(is_null($maybe->get()), 'The value is NULL.');
        $this->ok($maybe->isEmpty(), 'The value is NULL.');
        $this->is('pika', $maybe->getOrElse('pika'), '`getOrElse()` returns given default.');

        $maybe = new \PHPZ\Maybe('plop');
        $this->is('plop', $maybe->get(), 'Get returns the given string');
        $this->is('Just(plop)', (string) $maybe, '`__toString()` return formated string.');
        $this->ok(!$maybe->isEmpty(), '`isEmpty()` is false.');
        $this->is('plop', $maybe->getOrElse('pika'), '`getOrElse()` return current value.');
    }
}

$test = new MaybeTest();
$test->testMaybe();
