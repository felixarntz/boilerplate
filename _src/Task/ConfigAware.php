<?php
/**
 * Interface FelixArntz\Boilerplate\Task\ConfigAware
 *
 * @package FelixArntz\Boilerplate
 * @license GNU General Public License, version 2
 * @link    https://github.com/felixarntz/boilerplate
 */

namespace FelixArntz\Boilerplate\Task;

use FelixArntz\Boilerplate\Config;

/**
 * Interface for something that is aware of a configuration object.
 *
 * @since 1.0.0
 */
interface ConfigAware
{

    /**
     * Sets the configuration object.
     *
     * @since 1.0.0
     *
     * @param Config $config Configuration object.
     */
    public function setConfig(Config $config);

    /**
     * Gets the configuration object.
     *
     * @since 1.0.0
     *
     * @return Config Configuration object.
     */
    public function getConfig() : Config;
}
