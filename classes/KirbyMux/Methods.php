<?php

namespace KirbyMux;

use MuxPhp;

class Methods
{
    public static function upload($assetsApi, $url) {
        $file = getenv('MUX_DEV') ? "https://storage.googleapis.com/muxdemofiles/mux-video-intro.mp4" : $url;
        $input = new MuxPhp\Models\InputSettings(["url" => $file]);
        $createAssetRequest = new MuxPhp\Models\CreateAssetRequest(["input" => $input, "playback_policy" => [MuxPhp\Models\PlaybackPolicy::_PUBLIC] ]);
        $result = $assetsApi->createAsset($createAssetRequest);

        return $result;
    }
}
