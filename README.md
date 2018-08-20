# Google Static Maps plugin for Craft CMS 3.x

Provides a function to generate a signed URL for the Google Maps Static API

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require pinfirestudios/google-static-maps

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Google Static Maps.

## Google Static Maps Overview

Provides a TWIG variable, googleStaticMaps with a buildUrl() method that takes URL
parameters to pass into the Google Maps API.  It then adds the API key to the query,
signs it using the URL signing secret and returns the URL.  Also includes a img()
method that properly adds height/width attributes for you.

See https://developers.google.com/maps/documentation/maps-static/dev-guide for the possible
variables to pass into the function.

## Configuring Google Static Maps

Put your API key and signing secret either into a config file (using .env) or into the GUI.

## Using Google Static Maps

In twig:

    <img src="{{ craft.googleStaticMaps.buildUrl({
		center: "0,0",
		zoom: "10",
		size: "400x400",
	}) }}" >

or

    {{ craft.googleStaticMaps.img(400, 400, {
		center: "0,0",
		zoom: 10
	}) | raw }}

Brought to you by [Pinfire Studios](www.pinfirestudios.com)
