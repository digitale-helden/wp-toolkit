<?php

if(!function_exists('wp_notice'))
{
    /**
     * @param $message
     * @param $type
     */
    function wp_notice($message, $type)
    {
        if(function_exists('dh_notice'))
        {
            call_user_func_array('dh_notice', func_get_args());
        }else{
            // No dh-base theme is present so the notice handling needs to be implemented
            // in wordpress theme by adding a custom dh_notice() function that shows notice
            // messages accordingly.
        }
    }
}
