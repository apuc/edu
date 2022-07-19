<?php

namespace Kirill\Edu\some;

use Kirill\Edu\db\SoftDelete;

class Red
{
    use SoftDelete;
    /**
     * @var Some_2
     */
    public $someInst;

    public function __construct()
    {
        $this->someInst = Some_2::getInst();
    }

    public function useInst()
    {
//        echo "<pre>";
//        print_r($this->someInst);
        echo "<br>";
        echo $this->someInst->getSomeInfo();
    }

    /**
     * @return void
     *
     * @return string
     */
    public function getUserName()
    {
        echo "<br>";
        echo $this->someInst->getSomeInfo();
    }

}