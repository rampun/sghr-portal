<?php

if (!function_exists('vite_asset')) {
    function vite_asset($entry)
    {
        $manifestPath = public_path('build/.vite/manifest.json');

        if (!file_exists($manifestPath)) {
            $manifestPath = public_path('build/manifest.json');
        }

        if (!file_exists($manifestPath)) {
            return asset("build/{$entry}");
        }

        $manifest = json_decode(file_get_contents($manifestPath), true);

        if (isset($manifest[$entry])) {
            return asset('build/' . $manifest[$entry]['file']);
        }

        return asset("build/{$entry}");
    }
}
