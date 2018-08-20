<?php
/**
 * Google Static Maps plugin for Craft CMS 3.x
 *
 * Provides a function to generate a signed URL for the Google Maps Static API
 *
 * @link      www.pinfirestudios.com
 * @copyright Copyright (c) 2018 Pinfire Studios
 */

namespace pinfirestudios\googlestaticmaps\models;

use pinfirestudios\googlestaticmaps\GoogleStaticMaps;

use Craft;
use craft\base\Model;

/**
 * @author    Pinfire Studios
 * @package   GoogleStaticMaps
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
	public $googleMapsApiKey;

	/**
	 * @var string
	 */
	public $googleMapsStaticUrlSigningSecret;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
		return [
			[['googleMapsApiKey', 'googleMapsStaticUrlSigningSecret'], 'required'],
            ['googleMapsApiKey', 'string'],
			['googleMapsStaticUrlSigningSecret', 'string'],
        ];
    }
}
