<?php
namespace PHPZ;

class Maybe
{
    private $content = null;

    public function __construct($c = null)
    {
        $this->content = $c;
    }

    public function get()
    {
        return $this->content;
    }

    public function getOrElse($default)
    {
        return $this->content === null ? $default : $this->content;
    }

    public function isEmpty()
    {
        return $this->content === null;
    }

    public function __toString()
    {
        if($this->isEmpty()) {
            return 'Nothing';
        } else {
            return sprintf("Just(%s)", $this->content);
        }

    }
}
