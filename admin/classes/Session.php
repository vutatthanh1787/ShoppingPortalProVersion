<?php
/**
 * Created by PhpStorm.
 * User: thanh
 * Date: 11/12/2017
 * Time: 3:34 CH
 */

class Session
{
    public static function put($name, $value){
        return $_SESSION[$name] = $value;
    }
    public static function get($name){
        return $_SESSION[$name];
    }
    public static function exists($name){
        return (isset($_SESSION[$name])) ? true : false;
    }
    public static function delete($name){
        if (self::exists($name))
            unset($_SESSION[$name]);
    }
}