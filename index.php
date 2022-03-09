
<?php

@include_once __DIR__ . '/vendor/autoload.php';
Dotenv\Dotenv::createImmutable(kirby()->root('base'))->load(); // TODO: Add configurable path for .env

Kirby::plugin('robinscholz/kirby-mux', [
    'blueprints' => [
        'files/mux-video' => __DIR__ . '/blueprints/files/mux-video.yml',
        'blocks/mux-video' => __DIR__ . '/blueprints/blocks/mux-video.yml'
    ],
    'hooks' => [
        'file.create:after' => function (Kirby\Cms\File $file) {
            if ($file->type() !== 'video') { return; }

            // Authenticate
            $assetsApi = KirbyMux\Auth::assetsApi();

            // Upload the file to mux
            $result = KirbyMux\Methods::upload($assetsApi, $file->url());

            // Save mux data
            try {
                $file = $file->update([
                  'mux' => $result->getData()
                ]);
            } catch(Exception $e) {
                throw new Exception($e->getMessage());
            }
        },
        'file.delete:after' => function (Kirby\Cms\File $file) {
            if ($file->type() !== 'video') { return; }

            // Authentication setup
            $assetsApi = KirbyMux\Auth::assetsApi();

            // Get Mux Id
            $muxId = json_decode($file->mux())->id;

            // Delete Asset
            try {
                $assetsApi->deleteAsset($muxId);
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        },
        'file.replace:after' => function (Kirby\Cms\File $newFile, Kirby\Cms\File $oldFile) {
            if ($newFile->type() !== 'video') { return; }

             // Authentication setup
             $assetsApi = KirbyMux\Auth::assetsApi();

            // Upload new file to mux
             $result = KirbyMux\Methods::upload($assetsApi, $newFile->url());

             // Save playback Id
             try {
                 $newFile = $newFile->update([
                   'mux' => $result->getData()
                 ]);
             } catch(Exception $e) {
                throw new Exception($e->getMessage());
             }

             // Get old mux Id
             $muxId = json_decode($oldFile->mux())->id;

            // Delete old asset
            try {
                $assetsApi->deleteAsset($muxId);
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        }
    ]
]);
