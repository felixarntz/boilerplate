<?php
/**
 * Class FelixArntz\Boilerplate\Task\AbstractTask
 *
 * @package FelixArntz\Boilerplate
 * @license GNU General Public License v2 (or later)
 * @link    https://github.com/felixarntz/boilerplate
 */

namespace FelixArntz\Boilerplate\Task;

use FelixArntz\Boilerplate\Task;
use FelixArntz\Boilerplate\Config;
use Composer\Script\Event;

/**
 * Abstract class representing a task.
 *
 * @since 1.0.0
 */
abstract class AbstractTask implements Task
{

    /**
     * Creates a new task from a given event and configuration.
     *
     * @since 1.0.0
     *
     * @param Event  $event  The composer event that is being handled.
     * @param Config $config Configuration object.
     * @return Task New task instance.
     */
    public static function fromEventAndConfig(Event $event, Config $config) : Task
    {
        $task = new static();
        if ($task instanceof ConfigAware) {
            $task->setConfig($config);
        }
        if ($task instanceof IOAware) {
            $task->setIO($event->getIO());
        }
        return $task;
    }
}
