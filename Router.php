<?php namespace App\Core;

require './config.php';

use App\Core\Config;

class Router 
{
    const param   = '(\w+)';
    const baseUrl = Config::variables['baseUrl']; // '/development/corephp/router_hasin_hyder/';

    private static $noMatch = true;
    
    private static function getUrl()
    {
        return $_SERVER['REQUEST_URI'];
    }

    private static function process($pattern, $callback)
    {
        $pattern = "~^/?" . self::baseUrl . "$pattern" . "/?$~";
        $params = self::getMatches($pattern);

        if($params) {
            if(is_callable($callback)) { 

                $funcArgs = array_slice($params, 1);
                self::$noMatch = false;
                
                if(is_array($callback)) {
                    $className  = $callback[0];
                    $methodName = $callback[1];
                    $instance   = $className::getInstance();
                    $instance->$methodName(...$funcArgs);
                } else {  
                    $callback(...$funcArgs);
                }
            }
        }
    }

    private static function getMatches($pattern)
    {
        $url = self::getUrl();

        if(preg_match($pattern, $url, $matches))
        {
            return $matches;
        }

        return false;
    }

    static function get($pattern, $callback)
    {
        if ($_SERVER['REQUEST_METHOD'] != 'GET') return;

        self::process($pattern, $callback);
    }

    static function post($pattern, $callback)
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') return;

        self::process($pattern, $callback);
    }

    static function delete($pattern, $callback)
    {
        if ($_SERVER['REQUEST_METHOD'] != 'DELETE') return;

        self::process($pattern, $callback);
    }

    static function put($pattern, $callback)
    {
        if ($_SERVER['REQUEST_METHOD'] != 'PUT') return;

        self::process($pattern, $callback);
    }

    static function cleanup()
    {
        if(self::$noMatch)
        {
            echo "No Routes Matched";
        }
    }
}