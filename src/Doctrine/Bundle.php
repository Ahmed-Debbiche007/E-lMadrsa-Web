<?php

namespace App\Bundle;

use \Symfony\Component\DependencyInjection\ContainerInterface;

class Bundle
{

    private static $containerInstance = null;
    public function setContainer(ContainerInterface $container = null)
    {
        Bundle::setContainer($container);
        self::$containerInstance = $container;
    }
    public static function getContainer()
    {
        return self::$containerInstance;
    }
}
