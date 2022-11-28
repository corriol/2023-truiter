<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitcfb9740b5af249c32f1e4cbd3fbed581
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

        spl_autoload_register(array('ComposerAutoloaderInitcfb9740b5af249c32f1e4cbd3fbed581', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitcfb9740b5af249c32f1e4cbd3fbed581', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitcfb9740b5af249c32f1e4cbd3fbed581::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
