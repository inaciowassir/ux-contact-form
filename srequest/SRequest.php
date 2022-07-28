<?php 
namespace sprint\srequest;

class SRequest
{    
    public static function method()
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }
    
    public static function isPost()
    {
        return self::method() === "post";
    }
    
    public static function isGet()
    {
        return self::method() === "get";
    }
    
    public static function body()
    {
        $body = [];
            
        if(self::isPost())
        {            
            $body = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);         
        }
        
        if(self::isGet())
        {            
            $body = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);         
        }
        
        return $body;        
    }
    
    public static function query($name = null)
    {
        if(self::isGet())
        {
            try 
            {
                return ($name != null) ? (isset($_GET[$name]) ? htmlspecialchars($_GET[$name], ENT_QUOTES, 'UTF-8') : null) : self::getBody();                
            } catch (\Error $e) 
            {                
                return [];                
            }
        }
    }
    
    public static function ip()
    {
        return $_SERVER["REMOTE_ADDR"];
    }
    
    public static function agent()
    {
        return $_SERVER["HTTP_USER_AGENT"];
    }
    
    public static function refer()
    {
        return $_SERVER['HTTP_REFERER'];
    }
    
    public static function referHost()
    {
        return parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
    }
    
    public static function host()
    {
        return $_SERVER['HTTP_HOST'];
    }
}