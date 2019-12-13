<?php

if(!function_exists('dh_require'))
{
    /**
     * @param $file
     * @param array $vars
     * @param bool $echo
     * @return false|string
     */
    function dh_require($file, $vars = [], $echo = false)
    {
        ob_start();
        extract($vars);
        require_once $file;
        if((bool)$echo){
            echo ob_get_clean();
        }else{
            return ob_get_clean();
        }
    }
}
