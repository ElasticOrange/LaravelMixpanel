<?php namespace Hydrarulz\LaravelMixpanel;

use Illuminate\Support\Facades\Config;
use Mixpanel;

class LaravelMixpanel extends Mixpanel {

    protected $token;

    private static $_instance;

    /**
     * @param array $token
     * @param array $options
     */
    public function __construct($token, array $options = array())
    {
        $this->setToken($token);

        self::$_instance = parent::__construct($this->token, $options = array());
    }

    /**
     * @param bool  $token
     * @param array $options
     * @return LaravelMixpanel
     */
    public static function getInstance($token = false, $options = array())
    {
        if (!$token) {
            $token = Config::get('laravel-mixpanel.token');
        }
        if (!isset(self::$_instance)) {
            self::$_instance = new LaravelMixpanel($token, $options);
        }
        return self::$_instance;
    }

    public function hello()
    {
        echo "Hello world";
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }
}

