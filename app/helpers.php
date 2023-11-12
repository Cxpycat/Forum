<?php

use Illuminate\Support\Str;

if (!function_exists('getId')) {
    function getId($data, $pattern, $replacePattern)
    {
        return Str::of($data['content'])->matchAll($pattern)->unique()->transform(
            function ($id) use ($replacePattern){
                return Str::of($id)->replaceMatches($replacePattern, '')->value();
            });
    }
}
