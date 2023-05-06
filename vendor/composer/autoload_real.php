<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit565b9d1c0401d83c72c03aafa2dce158
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

        spl_autoload_register(array('ComposerAutoloaderInit565b9d1c0401d83c72c03aafa2dce158', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit565b9d1c0401d83c72c03aafa2dce158', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit565b9d1c0401d83c72c03aafa2dce158::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
