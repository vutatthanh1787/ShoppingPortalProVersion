<?php
/**
 * Created by PhpStorm.
 * User: thanh
 * Date: 11/12/2017
 * Time: 2:53 CH
 */

class Config
{
    public static function get($path = null){
        if ($path){
            $config = $GLOBALS['config'];
            $path = explode('/', $path);
            foreach ($path as $bit){
                if (isset($config[$bit]))
                    $config = $config[$bit];
            }
            return $config;
        }
        return false;
    }
}