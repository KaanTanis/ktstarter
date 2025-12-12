<?php

if (! function_exists('getLocalizedUrl')) {
    /**
     * Build a localized URL for the given locale.
     *
     * Falls back to the current request URI when no target path is provided.
     */
    function getLocalizedUrl(string $locale, ?string $path = null): string
    {
        $path ??= request()->getPathInfo();

        return \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL(
            $locale,
            $path,
            attributes: [],
        );
    }
}
