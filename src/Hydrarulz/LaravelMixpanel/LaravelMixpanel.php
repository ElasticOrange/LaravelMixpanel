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

    private static function getUniqueId()
    {
        if (isset($_COOKIE['mp_'. self::getToken() .'_mixpanel']))
        {
            $mixpanel_cookie = json_decode($_COOKIE['mp_'. $token .'_mixpanel']);
            return $mixpanel_cookie->distinct_id;
        }

        return false;
    }

    /**
     * @param bool  $token
     * @param array $options
     * @return LaravelMixpanel
     */
    public static function getInstance($token = false, $options = array())
    {
        if (!$token)
        {
            $token = Config::get('laravel-mixpanel.token');
        }

        /**
         * Init the library and use the generated cookie by the Javascript to identify the user.
         */
        if (!isset(self::$_instance))
        {
            self::$_instance = new LaravelMixpanel($token, $options);

            if (self::getUniqueId())
            {
                self::$_instance->identify(self::getUniqueId());
            }
        }
        return self::$_instance;
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
