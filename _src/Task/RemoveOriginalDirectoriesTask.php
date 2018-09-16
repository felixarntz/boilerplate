<?php
/**
 * Class FelixArntz\Boilerplate\Task\RemoveOriginalDirectoriesTask
 *
 * @package FelixArntz\Boilerplate
 * @license GNU General Public License, version 2
 * @link    https://github.com/felixarntz/boilerplate
 */

namespace FelixArntz\Boilerplate\Task;

use FelixArntz\Boilerplate\Util;
use Composer\Util\Filesystem;

/**
 * Class representing a task that removes the unnecessary directories from the original boilerplate.
 *
 * @since 1.0.0
 */
class RemoveOriginalDirectoriesTask extends AbstractTask
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
        return 'Removing original directories...';
    }

    /**
     * Completes the task.
     *
     * @since 1.0.0
     */
    public function complete()
    {
        $filesystem = new Filesystem();
        foreach ($this->getOriginalDirectories() as $directory) {
            $filesystem->removeDirectory(Util::getAbsolutePath($directory));
        }
    }

    /**
     * Gets the relative paths to the original directories to delete.
     *
     * @since 1.0.0
     *
     * @return array List of directory paths.
     */
    protected function getOriginalDirectories() : array
    {
        return [
            '_config',
            '_templates',
            '_vendor',
        ];
    }
}
