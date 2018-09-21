<?php
/**
 * Class FelixArntz\Boilerplate\Task\ReplacePlaceholdersTask
 *
 * @package FelixArntz\Boilerplate
 * @license GNU General Public License, version 2
 * @link    https://github.com/felixarntz/boilerplate
 */

namespace FelixArntz\Boilerplate\Task;

use Mustache_Engine;
use Symfony\Component\Finder\Finder;

/**
 * Class representing a task that replaces all the placeholders in the template files.
 *
 * @since 1.0.0
 */
class ReplacePlaceholdersTask extends AbstractTask implements ConfigAware
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
        return 'Replacing placeholders...';
    }

    /**
     * Completes the task.
     *
     * @since 1.0.0
     */
    public function complete()
    {
        $placeholders = $this->getPlaceholderValues();

        $mustache = new Mustache_Engine();
        $finder   = new Finder();
        foreach ($finder->files()->in('_templates')->name('/\.template$/') as $file) {
            $template = file_get_contents($file);
            $rendered = $mustache->render($template, $placeholders);
            file_put_contents($file, $rendered);
        }
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

        $settings = [];
        if (!empty($this->config['settings'])) {
            foreach ($this->config['settings'] as $key => $data) {
                $settings[$key] = $data['value'];
            }
        }

        if (!empty($this->config['generatedPlaceholders'])) {
            foreach ($this->config['generatedPlaceholders'] as $key => $callback) {
                $placeholders[$key] = call_user_func($callback, $placeholders, $settings);
            }
        }

        return array_merge($placeholders, $settings);
    }
}
