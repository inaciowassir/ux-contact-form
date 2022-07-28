<?php

declare(strict_types=1);

namespace sprint\sview;

/**
 * Class SView
 * @package sprint\sview
 */
class SView
{
    /**
     * @var array
     */
    static $blocks = array();
    /**
     * @var bool
     */
    static $cache_enabled = false;

    /**
     * @param $file
     * @param array $data
     */
    public static function view($file, $data = array())
    {
        $cached_file = self::cache($file);
        extract($data, EXTR_SKIP);

        require_once($cached_file);
    }

    /**
     * @param $file
     * @return string
     * @throws \Exception
     */
    public static function cache($file)
    {
        $cache_path = $_SERVER["APP_VIEWS_CACHE"] . "cache/";

        if (!file_exists($cache_path)) 
        {
            mkdir($cache_path, 0744);
        }

        $cached_file = $cache_path . str_replace(array('/', '.html'), array('_', ''), $file);
        if (!self::$cache_enabled || !file_exists($cached_file) || filemtime($cached_file) < filemtime($file)) {
            $code = self::cInclude($file);
            $code = self::cCode($code);
            file_put_contents($cached_file, $code);
        }
        return $cached_file;
    }

    /**
     * @return bool
     */
    public static function clear()
    {
        $cache_path = $_SERVER["APP_VIEWS_CACHE"] . "cache/";

        if (!file_exists($cache_path)) 
        {
            return false;
        }

        foreach (glob($cache_path . '*') as $file) 
        {
            unlink($file);
        }
    }

    /**
     * @param $code
     * @return mixed
     */
    public static function cCode($code)
    {
        $code = self::cBlock($code);
        $code = self::cYield($code);
        $code = self::cEscapedEchos($code);
        $code = self::cEchos($code);
        $code = self::cPHP($code);
        return $code;
    }

    /**
     * @param $file
     * @return mixed|string
     * @throws \Exception
     */
    public static function cInclude($file)
    {
        if (!file_exists($file)) throw new \Exception("Unable to extends or include the file. Please check the path or if the file exists");

        $code = file_get_contents($file);
        preg_match_all('/{% ?(extends|include) ?\'?(.*?)\'? ?%}/i', $code, $matches, PREG_SET_ORDER);
        foreach ($matches as $value) {
            $code = str_replace($value[0], self::cInclude($value[2]), $code);
        }
        $code = preg_replace('/{% ?(extends|include) ?\'?(.*?)\'? ?%}/i', '', $code);
        return $code;
    }

    /**
     * @param $code
     * @return mixed
     */
    public static function cPHP($code)
    {
        return preg_replace('~\{%\s*(.+?)\s*\%}~is', '<?php $1 ?>', $code);
    }

    /**
     * @param $code
     * @return mixed
     */
    public static function cEchos($code)
    {
        return preg_replace('~\{{\s*(.+?)\s*\}}~is', '<?php echo $1 ?>', $code);
    }

    /**
     * @param $code
     * @return mixed
     */
    public static function cEscapedEchos($code)
    {
        return preg_replace('~\{{{\s*(.+?)\s*\}}}~is', '<?php echo htmlentities($1, ENT_QUOTES, \'UTF-8\') ?>', $code);
    }

    /**
     * @param $code
     * @return mixed
     */
    public static function cBlock($code)
    {
        preg_match_all('/{% ?block ?(.*?) ?%}(.*?){% ?endblock ?%}/is', $code, $matches, PREG_SET_ORDER);
        foreach ($matches as $value) {
            if (!array_key_exists($value[1], self::$blocks))
                self::$blocks[$value[1]] = '';
            if (strpos($value[2], '@parent') === false) {
                self::$blocks[$value[1]] = $value[2];
            } else {
                self::$blocks[$value[1]] = str_replace('@parent', self::$blocks[$value[1]], $value[2]);
            }
            $code = str_replace($value[0], '', $code);
        }
        return $code;
    }

    /**
     * @param $code
     * @return mixed
     */
    public static function cYield($code)
    {
        foreach (self::$blocks as $block => $value) {
            $code = preg_replace('/{% ?yield ?' . $block . ' ?%}/', $value, $code);
        }
        $code = preg_replace('/{% ?yield ?(.*?) ?%}/i', '', $code);
        return $code;
    }
}
