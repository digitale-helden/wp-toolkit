<?php

if(!function_exists('dh_option_as_object'))
{
    /**
     * Get an option value as object where the value can be a serialized array or json string or string key: value pairs
     * for multiline options as string
     *
     * @param string $option expects the option name
     * @param null|string $path expects optional path for getting part of object
     * @param bool $strict whether to discard invalid option values
     * @return stdClass
     * @throws Exception
     */
    function dh_option_as_object($option, $path = null, $strict = false)
    {
        $o = new \stdClass();
        $object = (object)get_option($option, new \stdClass());
        if($path !== null)
        {
            $object = dh_object_get($object, $path, new \stdClass());
        }
        if(is_object($object)) {
            return $object;
        }else if(is_array($object)){
            return (object)$object;
        }else{
            $lines = preg_split("=\n=i", trim($object));
            foreach($lines as $line)
            {
                $line = preg_split('=^([^\:]{1,}\:\s*)=i', $line, -1, PREG_SPLIT_DELIM_CAPTURE);
                $line[1] = trim($line[1], ' :');
                $line[2] = stripslashes(str_replace(array("\n", "\r"), '', trim($line[2], ' :')));
                if((bool)$strict && (!isset($line[2]) || empty($line[2])))
                {
                    continue;
                }
                if(preg_match('=^(\{|\[\{)(\"[0-9A-Z\-\_\.]{1,})\"\:=i', $line[2]))
                {
                    $o->{$line[1]} = json_decode($line[2]);
                }else{
                    $o->{$line[1]} = $line[2];
                }
            }
            return $o;
        }
    }
}
