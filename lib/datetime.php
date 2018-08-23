<?php

if(!function_exists('dh_is_timestamp'))
{
    /**
     * check a timestamp value if is valid unix timestamp int value. if second parameter
     * exists will check also if timestamp is > time value passed in second parameter
     * which must be a valid php time() value = unix timestamp or true meaning now
     *
     * @param null|mixed $timestamp expects the timestamp to check as int or string
     * @param null|int|bool $time expects optional timestamp - see explanation above
     * @return bool
     */
    function dh_is_timestamp($timestamp = null, $time = null)
    {
        $check = null;
        $return = false;

        if($timestamp !== null)
        {
            if(is_int($timestamp) || is_float($timestamp))
            {
                $check = $timestamp;
            }else{
                $check = (string)(int)$timestamp;
            }
            $return = ($check === $timestamp) && ((int)$timestamp <= PHP_INT_MAX) && ((int)$timestamp >= ~PHP_INT_MAX);
            if($return && $time !== null)
            {
                if($time === true) $time = time();
                return ((int)$timestamp >= (int)$time) ? true : false;
            }
        }
        return $return;
    }
}


if(!function_exists('dh_datetime'))
{
    /**
     * return mysql datetime conform date time value from timestamp passed in first argument
     *
     * @param null|int $time timestamp if set (if not assumes php time()
     * @param string $format expects the date time format - see strftime
     * @return string
     */
    function dh_datetime($time = null, $format = '%Y-%m-%d %H:%M:%S')
    {
        return strftime((string)$format, (($time !== null) ? (int)$time : time()));
    }
}
