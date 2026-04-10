<?php
/**
 * Google Static Maps plugin for Craft CMS 3.x
 *
 * Provides a function to generate a signed URL for the Google Maps Static API
 *
 * @link      www.pinfirestudios.com
 * @copyright Copyright (c) 2018 Pinfire Studios
 */

namespace pinfirestudios\googlestaticmaps;

use pinfirestudios\googlestaticmaps\variables\GoogleStaticMapsVariable;
use pinfirestudios\googlestaticmaps\models\Settings;

use Craft;
use craft\base\Model;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;

/**
 * Class GoogleStaticMaps
 *
 * @author    Pinfire Studios
 * @package   GoogleStaticMaps
 * @since     1.0.0
 *
 */
class GoogleStaticMaps extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var GoogleStaticMaps
     */
    public static GoogleStaticMaps $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public string $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('googleStaticMaps', GoogleStaticMapsVariable::class);
            }
        );

        Craft::info(
            Craft::t(
                'google-static-maps',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    protected function createSettingsModel(): ?Model
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): ?string
    {
        return Craft::$app->view->renderTemplate(
            'google-static-maps/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }
}
