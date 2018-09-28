<?php
/**
 * Class FelixArntz\Boilerplate\Task\RemoveOriginalFilesTask
 *
 * @package FelixArntz\Boilerplate
 * @license GNU General Public License, version 2
 * @link    https://github.com/felixarntz/boilerplate
 */

namespace FelixArntz\Boilerplate\Task;

use FelixArntz\Boilerplate\Util;
use Composer\Util\Filesystem;

/**
 * Class representing a task that removes the unnecessary files from the original boilerplate.
 *
 * @since 1.0.0
 */
class RemoveOriginalFilesTask extends AbstractTask
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
        return 'Removing original files...';
    }

    /**
     * Completes the task.
     *
     * @since 1.0.0
     */
    public function complete()
    {
        $filesystem = new Filesystem();
        foreach ($this->getOriginalFiles() as $file) {
            $filesystem->remove(Util::getAbsolutePath($file));
        }
    }

    /**
     * Gets the relative paths to the original files to delete.
     *
     * @since 1.0.0
     *
     * @return array List of file paths.
     */
    protected function getOriginalFiles() : array
    {
        return [
            '.editorconfig',
            '.gitignore',
            'composer.json',
            'composer.lock',
            'phpcs.xml.dist',
            'phpmd.xml.dist',
            'LICENSE.md',
            'README.md',
        ];
    }
}
