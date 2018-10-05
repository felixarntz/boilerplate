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
        return 'Replacing placeholders...';
    }

    /**
     * Completes the task.
     *
     * @since 1.0.0
     */
    public function complete()
    {
        $settings = $this->getSettingValues(
            !empty($this->config['settings']) ? $this->config['settings'] : []
        );

        $placeholders = $this->getPlaceholderValues(
            !empty($this->config['placeholders']) ? $this->config['placeholders'] : [],
            !empty($this->config['generatedPlaceholders']) ? $this->config['generatedPlaceholders'] : [],
            $settings
        );

        $placeholders = array_merge($placeholders, $settings);

        $mustache = new Mustache_Engine();
        $finder   = new Finder();
        foreach ($finder->files()->ignoreDotFiles(false)->in('_templates')->name('/\.template$/') as $file) {
            $template = file_get_contents($file);
            $rendered = $mustache->render($template, $placeholders);
            file_put_contents(substr($file, 0, -strlen('.template')), $rendered);
        }
    }
}
