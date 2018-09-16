<?php
/**
 * Class FelixArntz\Boilerplate\Task\RemoveOriginalVersionControlTask
 *
 * @package FelixArntz\Boilerplate
 * @license GNU General Public License, version 2
 * @link    https://github.com/felixarntz/boilerplate
 */

namespace FelixArntz\Boilerplate\Task;

use FelixArntz\Boilerplate\Util;
use Composer\Util\Filesystem;

/**
 * Class representing a task that removes the original version control directory.
 *
 * @since 1.0.0
 */
class RemoveOriginalVersionControlTask extends AbstractTask
{

    /**
     * Gets the initial status message to show before the task starts execution.
     *
     * @since 1.0.0
     *
     * @return string Status message.
     */
    public function getStatusMessage() : string
    {
        return 'Removing original version control...';
    }

    /**
     * Completes the task.
     *
     * @since 1.0.0
     */
    public function complete()
    {
        (new Filesystem())->removeDirectory(Util::getAbsolutePath('.git'));
    }
}
