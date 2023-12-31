<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit08b702f8c664f254e23ffda585fc1fbc
{
    public static $prefixLengthsPsr4 = array (
        'U' => 
        array (
            'User\\Cms\\' => 9,
        ),
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'User\\Cms\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit08b702f8c664f254e23ffda585fc1fbc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit08b702f8c664f254e23ffda585fc1fbc::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit08b702f8c664f254e23ffda585fc1fbc::$classMap;

        }, null, ClassLoader::class);
    }
}
