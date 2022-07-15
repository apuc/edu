<?php

class Some
{
    public $var;
    private $var1;
    protected $var2;

    public function __construct()
    {
        $this->var = 'some';
    }

    public static function stat()
    {
        echo 'stat';
    }

}