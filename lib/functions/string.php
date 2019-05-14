<?php

if(!function_exists('dh_is_json'))
{
    /**
     * check if a string is a json encoded string
     *
     * @param string $string expects the string to check
     * @param bool $ignore_scalars expects the scalar flag
     * @return bool
     */
    function dh_is_json($string, $ignore_scalars = true)
    {
    	if(!is_string($string) || empty($string))
    	{
    		return false;
    	}
    	if($ignore_scalars && ! in_array($string[0], array( '{', '[' ), true))
    	{
    		return false;
    	}

    	@json_decode($string, $assoc = true);

    	return (json_last_error() === JSON_ERROR_NONE);
    }


    /**
     * check if first argument is a serialized string
     *
     * @param mixed $mixed expects mixed data
     * @return bool
     */
    function dh_is_serialized($mixed)
    {
        if(is_string($mixed))
        {
            if(function_exists('is_serialized'))
            {
                return is_serialized($mixed);
            }else{
                return (@unserialize($mixed) !== false);
            }
        }else{
            return false;
        }
    }
}
