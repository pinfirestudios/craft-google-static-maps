<?php
/**
 * Google Static Maps plugin for Craft CMS 3.x
 *
 * Provides a function to generate a signed URL for the Google Maps Static API
 *
 * @link      www.pinfirestudios.com
 * @copyright Copyright (c) 2018 Pinfire Studios
 */

namespace pinfirestudios\googlestaticmaps\variables;

use Craft;
use pinfirestudios\googlestaticmaps\GoogleStaticMaps;
use yii\helpers\Html;

/**
 * @author    Pinfire Studios
 * @package   GoogleStaticMaps
 * @since     1.0.0
 */
class GoogleStaticMapsVariable
{
	const BASE_DOMAIN = 'https://maps.googleapis.com';
	const BASE_PATH = '/maps/api/staticmap';

    // Public Methods
    // =========================================================================

    /**
     * @param array $params paramaters to pass into {@see http_build_query} to build the map.
     * @return string
     */
    public function buildUrl(array $params) : string
	{
		$settings = GoogleStaticMaps::$plugin->getSettings();

		$params['key'] = $settings->googleMapsApiKey;
		$query = http_build_query($params, null, '&', PHP_QUERY_RFC3986);

		$partToSign = self::BASE_PATH . '?' . $query;

		$signingSecret = $settings->googleMapsStaticUrlSigningSecret;
		$decodedKey = base64_decode(str_replace(['-', '_'], ['+', '/'], $signingSecret));

		$signature = hash_hmac('sha1', $partToSign, $decodedKey, true);
		$encodedSignature = str_replace(['+', '/'], ['-','_'], base64_encode($signature));

        return self::BASE_DOMAIN . self::BASE_PATH . '?' . $query . '&signature=' . $encodedSignature;
	}

	/**
	 * Returns an <img> tag for the given parameters.
	 *
	 * @param int $width
	 * @param int $height
	 * @param array $mapParams {@see buildUrl()}
	 * @param array $htmlOptions additional attributes to add to the <img> tag.
	 * @return string <img> tag.
	 */
	public function img(int $width, int $height, array $mapParams, array $htmlOptions = []) : string
	{
		$mapParams['size'] = "{$width}x{$height}";

		$url = $this->buildUrl($mapParams);

		$htmlOptions['width'] = $width;
		$htmlOptions['height'] = $height;

		return Html::img($url, $htmlOptions);
	}

	/**
	 * Returns an <img> tag inside a <a> with a link to open in Google Maps.
	 *
	 * @param int $width
	 * @param int $height
	 * @param array $mapParams {@see buildUrl()}
	 * @param array $htmlOptions additional attributes to add to the <img> tag.
	 * @return string <a><img> tags.
	 */
	public function link(int $width, int $height, array $mapParams, array $linkOptions = [], array $imageOptions = []) : string
	{
		$img = $this->img($width, $height, $mapParams, $imageOptions);

		$addr = '';
		if (isset($linkOptions['address']))
		{
			$addr = $linkOptions['address'] . '/';
			unset($linkOptions['address']);
		}

		$mapsUrl = "https://www.google.com/maps/search/{$addr}@{$mapParams['center']},{$mapParams['zoom']}z/";

		return Html::a($img, $mapsUrl, $linkOptions);
	}
}
