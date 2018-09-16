<?php
/**
 * Class FelixArntz\Boilerplate\Task\InitializeVersionControlTask
 *
 * @package FelixArntz\Boilerplate
 * @license GNU General Public License, version 2
 * @link    https://github.com/felixarntz/boilerplate
 */

namespace FelixArntz\Boilerplate\Task;

use FelixArntz\Boilerplate\Util;
use RuntimeException;

/**
 * Class representing a task that initializes version control for the project.
 *
 * @since 1.0.0
 */
class InitializeVersionControlTask extends AbstractTask
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
     *
     * @throws RuntimeException Thrown when version control cannot be initialized.
     */
    public function complete()
    {
        $directory = Util::getRootPath();
        $command   = sprintf('cd %1$s && git init', escapeshellarg($directory));

        exec($command, $output, $return);
        if ($return !== 0) {
            throw new RuntimeException(
                sprintf(
                    'Could not initialize version control in directory "%1$s". [Exit Status: %2$d]',
                    $directory,
                    $return
                )
            );
        }
    }
}
