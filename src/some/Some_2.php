<?php
namespace Kirill\Edu\some;

class Some_2 extends Some
{
    use SomeTrait;

    public function getSomeInfo()
    {
        return "info";
    }

}