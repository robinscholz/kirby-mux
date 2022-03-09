# 📼 Kirby MUX

A (Kirby)[https://getkirby.com/] plugin to upload video files to (MUX)[https://mux.com/].

## Installation

### Download

Download and copy this repository to `/site/plugins/{{ plugin-name }}`.

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

> This plugin includes a .env.example file as well.

### MUX_TOKEN_ID

In order for the plugin to work, you need to create an `API Access Token` on the MUX dashboard. Save the `Token ID` here.

### MUX_TOKEN_SECRET

Save the associated `Token Secret` here.

## MUX_DEV

Set this to `true` for local development. Instead of the actual video, the plugin will upload a test video to MUX. This is neccessary, since videos need to be publicly hosted for MUX to be able to import them.


## Plugin Development

We use [kirbyup](https://github.com/johannschopplich/kirbyup) for the development and build setup.

You can start developing directly. kirbyup will be fetched remotely with your first `npm run` command, which may take a short amount of time.

### Development

Start the dev process with:

```
npm run dev
```

This will automatically update the `index.js` and `index.css` of your plugin as soon as you make changes.
Reload the Panel to see your code changes reflected.

### Production

Build final files with:

```
npm run build
```

This will automatically create a minified and optimized version of your `index.js` and `index.css`
which you can ship with your plugin.

## License

MIT
