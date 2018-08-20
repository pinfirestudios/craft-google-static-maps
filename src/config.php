<?php
/**
 * Google Static Maps plugin for Craft CMS 3.x
 *
 * Provides a function to generate a signed URL for the Google Maps Static API
 *
 * @link      www.pinfirestudios.com
 * @copyright Copyright (c) 2018 Pinfire Studios
 */

/**
 * Google Static Maps config.php
 *
 * This file exists only as a template for the Google Static Maps settings.
 * It does nothing on its own.
 *
 * Don't edit this file, instead copy it to 'craft/config' as 'google-static-maps.php'
 * and make your changes there to override default settings.
 *
 * Once copied to 'craft/config', this file will be multi-environment aware as
 * well, so you can have different settings groups for each environment, just as
 * you do for 'general.php'
 */

return [
	'googleMapsApiKey' => getenv('GOOGLE_MAPS_API_KEY'),
	'googleMapsStaticUrlSigningSecret' => getenv('GOOGLE_MAPS_SIGNING_SECRET'),
];
