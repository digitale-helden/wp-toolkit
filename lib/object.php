<?php

if(!function_exists('dh_object_get'))
{
    /**
     * Get value from object by key where multi dimensional objects/array keys can be retrieved with "." notation
     *
     * @param $object
     * @param null $key
     * @param null $default
     * @return array|mixed|object
     * @throws Exception
     */
    function dh_object_get($object, $key = null, $default = null)
    {
        if(is_object($object))
        {
            $object = dh_object_to_array($object);
            $o = true;
        }else{
            $object = (array)$object;
            $o = false;
        }
        if($key !== null)
        {
            if(array_key_exists($key, $object))
            {
                return ($o) ? dh_array_to_object($object[$key]) : $object[$key];
            }
            foreach(explode('.', trim($key, '.')) as $k => $v)
            {
                if(!is_array($object) || !array_key_exists($v, $object))
                {
                    return dh_default($default);
                }
                $object = $object[$v];
                if(is_object($object))
                {
                    $object = dh_object_to_array($object);
                }
            }
        }
        return ($o) ? dh_array_to_object($object) : $object;
    }
}


if(!function_exists('dh_object_set'))
{
    /**
     * Set a value at key position where key can be a "." notation style key location in a multi dimensional object/array
     *
     * @param $object
     * @param null $key
     * @param null $value
     * @return array|mixed|null|object
     * @throws Exception
     */
    function dh_object_set(&$object, $key = null, $value = null)
    {
        if(is_object($object))
        {
            $object = dh_object_to_array($object);
            $o = true;
        }else{
            $object = (array)$object;
            $o = false;
        }
        if($key === null)
        {
            $object = $value;
            if($o)
            {
                $object = dh_array_to_object($object);
            }
            return $object;
        }
        if(strpos($key, '.') === false)
        {
            $object[$key] = $value;
            if($o)
            {
                $object[$key] = dh_array_to_object($object[$key]);
            }
            return $object[$key];
        }
        $keys = explode('.', trim($key, '.'));
        while(count($keys) > 1)
        {
            $key = array_shift($keys);
            if(!isset($object[$key]) || !is_array($object[$key]))
            {
                $object[$key] = [];
            }
            $object =& $object[$key];
        }
        $object[array_shift($keys)] = $value;
        if($o)
        {
            $object = dh_array_to_object($object);
        }
        return null;
    }
}


if(!function_exists('dh_object_unset'))
{
    /**
     * Unset at key where key can be a "." notation style key location in a multi dimensional object/array
     *
     * @param $object
     * @param null $key
     * @throws Exception
     */
    function dh_object_unset(&$object, $key = null)
    {
        if(is_object($object))
        {
            $object = dh_object_to_array($object);
            $o = true;
        }else{
            $object = (array)$object;
            $o = false;
        }
        if($key === null)
        {
            $object = [];
        }else{
            if(array_key_exists($key, $object))
            {
                unset($object[$key]);
            }else{
                $keys = explode('.', trim($key, '.'));
                while(count($keys) > 1)
                {
                    $key = array_shift($keys);
                    if(!isset($object[$key]) or ! is_array($object[$key]))
                    {
                        return;
                  	}
                    $object =& $object[$key];
                }
                unset($object[array_shift($keys)]);
            }
        }
        if($o)
        {
            $object = dh_array_to_object($object);
        }
    }
}


if(!function_exists('dh_object_isset'))
{
    /**
     * Check if a key/value exists where key can be a "." notation style key location in a multi dimensional object/array
     *
     * @param $object
     * @param null $key
     * @param bool $strict
     * @return bool
     * @throws Exception
     */
    function dh_object_isset($object, $key = null, $strict = false)
    {
        if(is_object($object))
        {
            $object = dh_object_to_array($object);
            $o = true;
        }else{
            $object = (array)$object;
            $o = false;
        }
        if($key === null)
        {
            return (!empty($object)) ? true : false;
        }
        if(array_key_exists($key, $object))
        {
            if((bool)$strict)
            {
                return (dh_is_value($object[$key])) ? true : false;
            }else{
                return true;
            }
        }
        foreach(explode('.', trim($key, '.')) as $k => $v)
        {
            if(!is_array($object) || !array_key_exists($v, $object))
            {
                return false;
            }
            $object = $object[$v];
        }
        if($o)
        {
            $object = dh_array_to_object($object);
        }
        if((bool)$strict)
        {
            return (dh_is_value($object)) ? true : false;
        }else{
            return true;
        }
    }
}


if(!function_exists('dh_array_to_object'))
{
    /**
     * Convert an array to object
     *
     * @param $array
     * @param null $default
     * @return array|mixed|object
     * @throws Exception
     */
    function dh_array_to_object($array, $default = null)
    {
        if(($array = json_encode($array)) !== false)
        {
            return json_decode($array, false);
        }else{
            return dh_default($default);
        }
    }
}


if(!function_exists('dh_object_to_array'))
{
    /**
     * Convert an object to array
     *
     * @param $object
     * @param null $default
     * @return array|mixed|object
     * @throws Exception
     */
    function dh_object_to_array($object, $default = null)
    {
        if(($object = json_encode($object)) !== false)
        {
            return json_decode($object, true);
        }else{
            return dh_default($default);
        }
    }
}
