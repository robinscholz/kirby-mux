<?php

namespace KirbyMux;

use MuxPhp;
use GuzzleHttp;

class Auth
{
    public static function assetsApi() {
        // Authentication setup
        $config = MuxPhp\Configuration::getDefaultConfiguration()
            ->setUsername($_ENV['MUX_TOKEN_ID'])
            ->setPassword($_ENV['MUX_TOKEN_SECRET']);

        // API client initialization
        $assetsApi = new MuxPhp\Api\AssetsApi(
            new GuzzleHttp\Client(),
            $config
        );

        return $assetsApi;
    }
}
