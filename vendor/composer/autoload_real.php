<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitb0f11db99b4a54fcaa3a51fefdd9396f
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitb0f11db99b4a54fcaa3a51fefdd9396f', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitb0f11db99b4a54fcaa3a51fefdd9396f', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitb0f11db99b4a54fcaa3a51fefdd9396f::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
