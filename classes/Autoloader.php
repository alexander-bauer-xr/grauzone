<?php
// classes/Autoloader.php

class Autoloader {
    public static function register() {
        spl_autoload_register(function ($class) {
            $baseDir = __DIR__ . '/';
            $relativeClass = str_replace('\\', '/', $class);
            $file = $baseDir . $relativeClass . '.php';

            if (file_exists($file)) {
                include_once $file;
            } else {
                $directories = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($baseDir)
                );

                foreach ($directories as $directory) {
                    if ($directory->isFile()) {
                        if ($directory->getBasename('.php') === basename($relativeClass)) {
                            include_once $directory->getPathname();
                            return;
                        }
                    }
                }
                throw new \Exception("Unable to load class: $class");
            }
        });
    }
}