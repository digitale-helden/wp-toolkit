<?php

if(!function_exists('dh_default'))
{
    /**
     * handle default return values
     *
     * @param $value
     * @return mixed
     * @throws Exception
     */
    function dh_default($value)
    {
        if($value instanceof \Exception)
        {
            throw $value;
        }else if(is_callable($value) || (is_string($value) && function_exists($value))){
            return call_user_func($value);
        }else if($value === 'exit'){
            exit(0);
        }
        return $value;
    }
}


if(!function_exists('dh_is_value'))
{
    /**
     * check if value is anything but null, false, empty array, empty object or empty string
     *
     * @param null $value
     * @return bool
     */
    function dh_is_value($value = null)
    {
        if(is_null($value))
        {
            return false;
        }
        if(is_bool($value) && $value === false)
        {
            return false;
        }
        if(is_array($value) && empty($value))
        {
            return false;
        }
        if(is_string($value) && $value === '')
        {
            return false;
        }
        return true;
    }
}
