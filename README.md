# 📼 Kirby Mux

A [Kirby](https://getkirby.com) plugin to upload video files to [Mux](https://mux.com).

## Installation

### Download

Download and copy this repository to `/site/plugins/kirby-mux`.

### Git submodule

```
git submodule add https://github.com/robinscholz/kirby-mux.git site/plugins/kirby-mux
```

### Composer

```
composer require robinscholz/kirby-mux
```

## Configuration

Add a .env file to the root of your Kirby plugin with the following properties:

| Key              | Type      |
| ---------------- | --------- |
| MUX_TOKEN_ID     | `String`  |
| MUX_TOKEN_SECRET | `String`  |
| MUX_DEV          | `Boolean` |

### MUX_TOKEN_ID

In order for the plugin to work, you need to create an `API Access Token` on the MUX dashboard. Save the `Token ID` here.

### MUX_TOKEN_SECRET

Save the associated `Token Secret` here.

### MUX_DEV

Set this to `true` for local development. Instead of the actual video, the plugin will upload a test video to Mux. This is neccessary, since videos need to be publicly hosted for Mux to be able to import them.

> **NOTE:** This plugin includes a .env.example file as well.

## Caveats

The plugin does not include any frontend facing code or snippets. In order to stream the videos from Mux you need to implement your own custom video player. [HLS.js](https://github.com/video-dev/hls.js/) is a good option for example.

## Plugin Development

[Kirbyup](https://github.com/johannschopplich/kirbyup) is used for the development and build setup.

Kirbyup will be fetched remotely with your first `npm run` command, which may take a short amount of time.

### Development

Start the dev process with:

```
npm run dev
```

This will automatically update the `index.js` and `index.css` of the plugin as soon as changes are made.
Reload the Panel to see the code changes reflected.

### Production

Build final files with:

```
npm run build
```

This will automatically create a minified and optimized version of the `index.js` and `index.css`.

## License

MIT
