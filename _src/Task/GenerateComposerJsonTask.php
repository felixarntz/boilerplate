<?php
/**
 * Class FelixArntz\Boilerplate\Task\GenerateComposerJsonTask
 *
 * @package FelixArntz\Boilerplate
 * @license GNU General Public License v2 (or later)
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
    use ConfigAwareTrait, GetPlaceholderValuesTrait;

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

        $settings = $this->getSettingValues(
            !empty($this->config['settings']) ? $this->config['settings'] : []
        );

        $placeholders = $this->getPlaceholderValues(
            !empty($this->config['placeholders']) ? $this->config['placeholders'] : [],
            !empty($this->config['generatedPlaceholders']) ? $this->config['generatedPlaceholders'] : [],
            $settings
        );

        $composerData = call_user_func($this->config['composerGenerator'], $placeholders, $settings);
        $composerData = json_encode($composerData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        // Ensure JSON is indented with 2 spaces instead of the default 4.
        $composerData = preg_replace_callback('/^([ ]+)/m', function(array $matches) {
            return str_repeat(' ', strlen($matches[1]) / 2);
        }, $composerData);

        file_put_contents(Util::getAbsolutePath('composer.json'), $composerData);
    }
}
