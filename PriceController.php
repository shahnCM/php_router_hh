<?php namespace App\Core;

class PriceController 
{
    private static $instance;
    public static function getInstance()
    {
        if(!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }
    
    public static function showPrice()
    {
        echo "<br>Price is 10 Taka!</br>";
    }
}