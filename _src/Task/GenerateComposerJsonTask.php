<?php
/**
 * Class FelixArntz\Boilerplate\Task\GenerateComposerJsonTask
 *
 * @package FelixArntz\Boilerplate
 * @license GNU General Public License, version 2
 * @link    https://github.com/felixarntz/boilerplate
 */

namespace FelixArntz\Boilerplate\Task;

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
     */
    public function complete()
    {

    }
}
