<?php
namespace Kirill\Edu\some;

class Some
{
    public $var;
    private $var1;
    protected $var2;
    private static $inst = null;

    public function __construct()
    {
        echo "create Some";
        $this->var = 'some';
    }

    public static function stat()
    {
        echo 'stat';
    }

    public static function setInst()
    {
        $name = get_called_class();
        self::$inst = new $name();
    }

    public static function getInst()
    {

        if (empty(self::$inst)) {
            echo "step create";
            self::setInst();
        }

        return self::$inst;
    }

}