<?php

if(!function_exists('dh_array_is_assoc'))
{
    /**
     * check whether an array has only numeric keys
     *
     * @param mixed $array expects the array
     * @return bool
     */
    function dh_array_is_assoc($array)
    {
        if(!is_array($array))
        {
            return false;
        }
        return (bool)(count(array_filter(array_keys($array), 'is_string')) > 0);
    }
}
