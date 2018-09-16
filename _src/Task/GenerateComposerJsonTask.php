<?php
/**
 * Class FelixArntz\Boilerplate\Task\GenerateComposerJsonTask
 *
 * @package FelixArntz\Boilerplate
 * @license GNU General Public License, version 2
 * @link    https://github.com/felixarntz/boilerplate
 */

namespace FelixArntz\Boilerplate\Task;

use FelixArntz\Boilerplate\Util;
use RuntimeException;

/**
 * Class representing a task that generates the composer.json file.
 *
 * @since 1.0.0
 */
class GenerateComposerJsonTask extends AbstractTask implements ConfigAware
{
    use ConfigAwareTrait;

    /**
     * Gets the initial status message to show before the task starts execution.
     *
     * @since 1.0.0
     *
     * @return string Status message.
     */
    public function getStatusMessage() : string
    {
        return 'Generating composer.json...';
    }

    /**
     * Completes the task.
     *
     * @since 1.0.0
     *
     * @throws RuntimeException Thrown if the composer.json file cannot be generated.
     */
    public function complete()
    {
        if (empty($this->config['composerGenerator'])) {
            throw new RuntimeException('Missing required composer generator function in configuration.');
        }

        $placeholders = $this->getPlaceholderValues();
        $settings     = $this->getSettingValues();

        $composerData = call_user_func($this->config['composerGenerator'], $placeholders, $settings);
        $composerFile = Util::getAbsolutePath('composer2.json');

        file_put_contents($composerFile, json_encode($composerData, JSON_PRETTY_PRINT));
    }

    /**
     * Gets a map of placeholders and their values.
     *
     * @since 1.0.0
     *
     * @return array Map of $placeholder => $value pairs.
     */
    protected function getPlaceholderValues() : array
    {
        $placeholders = [];

        if (!empty($this->config['placeholders'])) {
            foreach ($this->config['placeholders'] as $key => $data) {
                $placeholders[$key] = $data['value'];
            }
        }

        if (!empty($this->config['generatedPlaceholders'])) {
            foreach ($this->config['generatedPlaceholders'] as $key => $callback) {
                $placeholders[$key] = call_user_func($callback, $this->config['placeholders']);
            }
        }

        return $placeholders;
    }

    /**
     * Gets a map of settings and their values.
     *
     * @since 1.0.0
     *
     * @return array Map of $setting => $value pairs.
     */
    protected function getSettingValues() : array
    {
        $settings = [];

        if (!empty($this->config['settings'])) {
            foreach ($this->config['settings'] as $key => $data) {
                $settings[$key] = $data['value'];
            }
        }

        return $settings;
    }
}
