<?php
/**
 * Class FelixArntz\Boilerplate\Task\MoveTemplateFilesTask
 *
 * @package FelixArntz\Boilerplate
 * @license GNU General Public License, version 2
 * @link    https://github.com/felixarntz/boilerplate
 */

namespace FelixArntz\Boilerplate\Task;

use Symfony\Component\Finder\Finder;

/**
 * Class representing a task that moves the necessary template files into the root.
 *
 * @since 1.0.0
 */
class MoveTemplateFilesTask extends AbstractTask implements ConfigAware
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
        return 'Moving template files...';
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
