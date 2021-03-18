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

if(!function_exists('dh_type'))
{
    /**
     * get type of variable
     *
     * @param null $value
     * @param false $convert
     * @return string|null
     */
    function dh_type($value = null, $convert = false)
    {
        if(is_string($value) && (bool)$convert)
        {
            if(is_numeric($value))
            {
                if((float)$value != (int)$value){
                    $value = (float)$value;
                }else{
                    $value = (int)$value;
               }
            }else{
                if($value === 'true' || $value === 'false')
                {
                    $value = (bool)$value;
                }
            }
        }

        if(is_object($value)){
            return 'object';
        }
        if(is_array($value)){
            return 'array';
        }
        if(is_resource($value)){
            return 'resource';
        }
        if(is_callable($value)){
            return 'callable';
        }
        if(is_file($value)){
            return 'file';
        }
        if(is_int($value)){
            return 'integer';
        }
        if(is_float($value)){
            return 'float';
        }
        if(is_bool($value)){
            return 'boolean';
        }
        if(is_null($value)){
            return 'null';
        }
        if(is_string($value)){
            return 'string';
        }
        return null;
    }
}


if(!function_exists('dh_normalize'))
{
    /**
     * normalize = typify values for use in json objects eg
     * @param $value
     * @return bool|float|int|string|null
     */
    function dh_normalize($value)
    {
        if(is_numeric($value) && (int)$value <= PHP_INT_MAX)
        {
            if((int)$value != $value){
                return (float)$value;
            }else if(filter_var($value, FILTER_VALIDATE_INT) !== false){
                return (int)$value;
            }else{
                return strval($value);
            }
        }else{
            if($value === 'true' || $value === 'TRUE')
            {
                return true;
            }else if($value === 'false' || $value === 'FALSE'){
                return false;
            }else if($value === 'null' || $value === 'NULL'){
                return null;
            }else{
                return strval($value);
            }
        }
    }
}
