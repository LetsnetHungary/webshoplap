<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8140dbf49c4f605b69186a4ff60de746
{
    public static $files = array (
        'a4406ac832814ce6b4087f95745515ed' => __DIR__ . '/../..' . '/CoreApp/GF.php',
    );

    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'CoreApp\\Model\\' => 14,
            'CoreApp\\Controller\\' => 19,
            'CoreApp\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'CoreApp\\Model\\' => 
        array (
            0 => __DIR__ . '/../..' . '/CoreAll/_models',
        ),
        'CoreApp\\Controller\\' => 
        array (
            0 => __DIR__ . '/../..' . '/CoreApp/_controllers',
        ),
        'CoreApp\\' => 
        array (
            0 => __DIR__ . '/../..' . '/CoreApp',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8140dbf49c4f605b69186a4ff60de746::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8140dbf49c4f605b69186a4ff60de746::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
