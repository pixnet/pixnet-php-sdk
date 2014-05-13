<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class PixLoader
{
    protected static function autoload($class)
    {
        if (class_exists($class, false) or interface_exists($class, false)) {
            return false;
        }
        $class = str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';
        $paths = explode(PATH_SEPARATOR, get_include_path());

        foreach ($paths as $path) {
            $path = rtrim($path, '/');
            if (file_exists($path . '/' . $class)) {
                require $class;
                return true;
            }
        }

        return false;
    }

    /**
     * registerAutoload
     *
     * @static
     * @access public
     * @return void
     */
    public static function registerAutoload()
    {
        spl_autoload_register(array('PixLoader', 'autoload'));
    }
}
