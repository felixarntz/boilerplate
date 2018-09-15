<?php
/**
 * Trait FelixArntz\Boilerplate\Task\ConfigAwareTrait
 *
 * @package FelixArntz\Boilerplate
 * @license GNU General Public License, version 2
 * @link    https://github.com/felixarntz/boilerplate
 */

namespace FelixArntz\Boilerplate\Task;

use FelixArntz\Boilerplate\Config;

/**
 * Trait for something that is aware of a configuration object.
 *
 * @since 1.0.0
 */
trait ConfigAwareTrait
{

    /**
     * Configuration object.
     *
     * @since 1.0.0
     * @var Config
     */
    protected $config;

    /**
     * Sets the configuration object.
     *
     * @since 1.0.0
     *
     * @param Config $config Configuration object.
     */
    public function setConfig(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Gets the configuration object.
     *
     * @since 1.0.0
     *
     * @return Config Configuration object.
     */
    public function getConfig() : Config
    {
        return $this->config;
    }
}
