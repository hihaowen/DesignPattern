<?php

/**
 * 单例模式
 *
 * 主要是为了防止对象重复调用
 */

class Singleton
{
    /**
     * @var
     */
    private static $instance;

    /**
     * 禁止用户直接实例化
     *
     * Singleton constructor.
     */
    private function __construct()
    {
    }

    /**
     * 让用户只能通过调用该静态方法的方式实例化该对象
     *
     * @return Singleton
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 调用 Demo
     */
    public function exec()
    {
        echo 'i am Singleton.', PHP_EOL;
    }
}

Singleton::getInstance()->exec();
