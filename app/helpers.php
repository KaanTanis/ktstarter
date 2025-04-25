<?php

if (! function_exists('getLocalizedUrl')) {
    function getLocalizedUrl($locale = null, $url = null, $attributes = [], $forceDefaultLocation = false): false|string
    {
        return LaravelLocalization::getLocalizedUrl($locale, $url, $attributes, $forceDefaultLocation);
    }
}