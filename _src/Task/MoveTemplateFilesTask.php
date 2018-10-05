<?php
/**
 * Class FelixArntz\Boilerplate\Task\MoveTemplateFilesTask
 *
 * @package FelixArntz\Boilerplate
 * @license GNU General Public License, version 2
 * @link    https://github.com/felixarntz/boilerplate
 */

namespace FelixArntz\Boilerplate\Task;

use FelixArntz\Boilerplate\Util;
use Composer\Util\Filesystem;

/**
 * Class representing a task that moves the necessary template files into the root.
 *
 * @since 1.0.0
 */
class MoveTemplateFilesTask extends AbstractTask implements ConfigAware
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
        return 'Moving template files...';
    }

    /**
     * Completes the task.
     *
     * @since 1.0.0
     *
     * @throws RuntimeException Thrown if template files cannot be moved.
     */
    public function complete()
    {
        if (empty($this->config['templatePicker'])) {
            throw new RuntimeException('Missing required template picker function in configuration.');
        }

        $settings = $this->getSettingValues(
            !empty($this->config['settings']) ? $this->config['settings'] : []
        );

        $placeholders = $this->getPlaceholderValues(
            !empty($this->config['placeholders']) ? $this->config['placeholders'] : [],
            !empty($this->config['generatedPlaceholders']) ? $this->config['generatedPlaceholders'] : [],
            $settings
        );

        $filesystem = new Filesystem();

        $templates = call_user_func($this->config['templatePicker'], $settings, $placeholders);
        foreach ($templates as $templateFile => $targetFile) {
            $rootPath         = Util::getRootPath();
            $templateFilePath = $rootPath . '/_templates/' . $templateFile;
            $targetFilePath   = $rootPath . '/' . $targetFile;

            if (!file_exists($templateFilePath)) {
                continue;
            }

            $filesystem->ensureDirectoryExists(dirname($targetFilePath));
            $filesystem->copyThenRemove($templateFilePath, $targetFilePath);
        }
    }
}
