<?php

/**
 * 适配器模式
 *
 * 主要是有些为了兼容一些老的业务需要
 *
 * 很形象的一个例子就是国内是三脚插座、但是国外的话有些插座是两脚的，这时候就需要用到适配器
 *
 * 代码的话，就省略吧 ...
 */

interface ZixiaSayInterface
{
    public function zhimakaimen();
}

class ZhiZunBao implements ZixiaSayInterface
{

    public function zhimakaimen()
    {
        // TODO: Implement zhimakaimen() method.
    }

}

class PanSiDong
{
    public function OpenTheDoor()
    {
        //
    }
}