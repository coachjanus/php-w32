<?php
namespace App\Core;

class Session
{
    private static $instance = null;

    private $messages = [];
    private $now = false;

    private function __construct()
    {
        ini_set("session.use_strict_mode", 1);
        ini_set("session.cookie_httponly", 1);
        ini_set("session.sid_length", 48);
        ini_set("session.sid_bits_per_character", 6);
        ini_set("session.hash_function", "sha256");
        ini_set("session.cache_limiter", 'nocache');
        ini_set("session.use_trans_sid", 0);
        session_start();

        $this->messages = self::get('flash_messages');
        self::set('flash_messages', []);
 
    }

    public static function instance()
    {
        if(self::$instance == null) {
            self::$instance = new Session;
        }
        return self::$instance;
    }

    public static function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    public static function set($key, $value)
    {
         $_SESSION[$key] = $value;
    }

    public static function unset($key)
    {
        unset ($_SESSION[$key]);
    }
    public static function destroy()
    {
        session_unset ();
    }

    public function replace($key, $value)
    {
        $this->unset($key);
        $this->set($key, $value);
    }


    public function message($name, $message)
    {
        if($this->now) {
            $this->messages[] = array(
                'name' => $name,
                'message' => $message
            );
        }else{
            $_SESSION['flash_messages'][] = array(
                'name' => $name,
                'message' => $message
            );
        }
    }

    public function now()
    {
        $this->now = true;
        return $this;
    }

    public function showFlash() 
    {
        if ($this->messages[0]) {
            return [$this->messages[0]['name'], $this->messages[0]['message']];
        }
        return null;
    }

    public function flasCount()
    {
        return $this->messages ? count($this->messages) : 0;
    }

}