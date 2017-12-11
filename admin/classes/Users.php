<?php
/**
 * Created by PhpStorm.
 * User: thanh
 * Date: 11/12/2017
 * Time: 10:23 SA
 */

class Users{
    public  $_data,
            $_mysqli,
            $_sessionName,
            $_isLoggedIn,
            $_error;
    public function __construct($user = null)
    {
        // Ket noi database
        $this->_mysqli = Database::getInstance();
        $this->_sessionName = Config::get('session_config/session_name');
        //echo '=>' . $this->_sessionName;
        // Neu k ton tai 1 user
        if (!$user){
            //echo 'session_name' . $this->_sessionName;
            if (Session::exists($this->_sessionName)){
                $user = Session::get($this->_sessionName);
                echo 'user = ' . $user;
                if ($this->find($user))
                    $this->_isLoggedIn = true;
            }
        }else{
            var_dump('find user = '. $this->find($user));
        }
    }

    public function select_users(){
        if (!$this->_mysqli->get_info('users'))
            throw new Exception('Select users have a problem!');
        $this->_data = $this->_mysqli->results();
    }

    public function find($user = null){
        if ($user){
            $field = is_numeric($user) ? 'id' : 'name';
            if ($this->_mysqli->get_info('users', $field, $user)){
                $data = $this->_mysqli->results();
                if (count($data) > 0){
                    $this->_data = $data;
                    return true;
                }
            }
        }
        return false;
    }

    public function find_user_by_email($email = ''){
        if (!is_int($email) && $email != ''){
            if ($query = $this->_mysqli->get_info('users', 'email', $email)){
                $data = $this->_mysqli->results();
                if (count($data) > 0){
                    $this->_data = $data;
                    return true;
                }
            }
        }
        return false;
    }

    public function find_user_by_name($name = ''){
        if (!is_int($name) && $name != ''){
            if ($query = $this->_mysqli->get_info('users', 'name', $name)){
                $data = $this->_mysqli->results();
                if (count($data) > 0){
                    $this->_data = $data;
                    return true;
                }
            }
        }
        return false;
    }

    public function login($username = null, $email = null, $password = null){
        $user = $this->find_user_by_name($username);
        if (!$username && !$password && $this->exists()){
            echo 'Da dang nhap roi';
        }
    }

    public function exists(){
        return (!empty($this->_data)) ? true : false;
    }

    public function data(){
        return $this->_data;
    }

    public function isLoggedIn(){
        return $this->_isLoggedIn;
    }
}