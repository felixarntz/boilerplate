<?php
/**
 * Class FelixArntz\Boilerplate\Setup
 *
 * @package FelixArntz\Boilerplate
 * @license GNU General Public License v2 (or later)
 * @link    https://github.com/felixarntz/boilerplate
 */

namespace FelixArntz\Boilerplate;

use FelixArntz\Boilerplate\Task\RequestPlaceholderValuesTask;
use FelixArntz\Boilerplate\Task\RequestSettingValuesTask;
use FelixArntz\Boilerplate\Task\VerifyConfigurationTask;
use FelixArntz\Boilerplate\Task\RemoveOriginalFilesTask;
use FelixArntz\Boilerplate\Task\ReplacePlaceholdersTask;
use FelixArntz\Boilerplate\Task\MoveTemplateFilesTask;
use FelixArntz\Boilerplate\Task\GenerateComposerJsonTask;
use FelixArntz\Boilerplate\Task\RemoveOriginalVersionControlTask;
use FelixArntz\Boilerplate\Task\InitializeVersionControlTask;
use FelixArntz\Boilerplate\Task\RemoveOriginalDirectoriesTask;
use Composer\Script\Event;
use Exception;

/**
 * Entry class for setting up a new project from the boilerplate.
 *
 * @since 1.0.0
 */
class Setup
{

    /**
     * Key for the composer extra object.
     *
     * @since 1.0.0
     */
    const EXTRA_KEY = 'wpadvanced-boilerplate';

    /**
     * Runs the project setup.
     *
     * @since 1.0.0
     *
     * @param Event $event The composer event that is being handled.
     *
     * @throws Exception Thrown if the setup fails.
     */
    public static function run(Event $event)
    {
        $event->getIO()->write('Setting up your project...');

        $config = static::getConfig($event);
        $tasks  = static::getTasks();

        foreach ($tasks as $task) {
            $task = call_user_func([$task, 'fromEventAndConfig'], $event, $config);

            $event->getIO()->write($task->getStatusMessage());

            try {
                $task->complete();
            } catch (Exception $e) {
                $event->getIO()->writeError(sprintf('<error>%s</error>', $e->getMessage()));
                throw $e;
            }
        }

        $event->getIO()->write('<info>Project setup completed.</info>');
    }

    /**
     * Gets the tasks required for the project setup.
     *
     * @since 1.0.0
     *
     * @return array List of {@see Task} instances.
     */
    protected static function getTasks() : array
    {
        return [
            RequestPlaceholderValuesTask::class,
            RequestSettingValuesTask::class,
            VerifyConfigurationTask::class,
            RemoveOriginalVersionControlTask::class,
            RemoveOriginalFilesTask::class,
            ReplacePlaceholdersTask::class,
            MoveTemplateFilesTask::class,
            GenerateComposerJsonTask::class,
            InitializeVersionControlTask::class,
            RemoveOriginalDirectoriesTask::class,
        ];
    }

    /**
     * Get the config.
     *
     * @since 1.0.0
     *
     * @param Event $event The composer event that is being handled.
     * @return Config Configuration object.
     */
    protected static function getConfig(Event $event) : Config
    {
        $extra = $event->getComposer()->getPackage()->getExtra();

        if (isset($extra[static::EXTRA_KEY]) && isset($extra[static::EXTRA_KEY]['config-file'])) {
            $configFile = $extra[static::EXTRA_KEY]['config-file'];
        } else {
            $configFile = '_config/defaults.php';
        }

        $configFile = __DIR__ . '/../' . $configFile;

        return Config::fromFile($configFile);
    }
}
