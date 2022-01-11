<?php

use Illuminate\Support\Collection;

if (!function_exists('str_ordinal')) {
    /**
     * Append an ordinal indicator to a numeric value.
     *
     * @param  string|int  $value
     * @param  bool  $superscript
     * @return string
     */
    function str_ordinal($value, $superscript = false)
    {
        $number = abs($value);
        $indicators = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];

        $suffix = $superscript ? '<sup>' . $indicators[$number % 10] . '</sup>' : $indicators[$number % 10];
        if ($number % 100 >= 11 && $number % 100 <= 13) {
            $suffix = $superscript ? '<sup>th</sup>' : 'th';
        }
        return number_format($number) . $suffix;
    }
}


if (!function_exists('get_prop')) {
    function get_prop(object|array $object, string $accessor)
    {
        $params = explode('.', $accessor);
        $result = $object;
        foreach ($params as $key => $param) {
            if (is_numeric($param))
                $result = $result[(int)$param];
            elseif ($result instanceof Collection)
            $result = $result[$param];
            elseif (gettype($result) == 'object')
                $result = $result->{$param};
            elseif (gettype($result) == 'array')
                $result = $result[$param];
        }
        return $result;
    }
}