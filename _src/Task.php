<?php
/**
 * Interface FelixArntz\Boilerplate\Task
 *
 * @package FelixArntz\Boilerplate
 * @license GNU General Public License, version 2
 * @link    https://github.com/felixarntz/boilerplate
 */

namespace FelixArntz\Boilerplate;

use Composer\Script\Event;

/**
 * Interface representing a task.
 *
 * @since 1.0.0
 */
interface Task
{

    /**
     * Gets the initial status message to show before the task starts execution.
     *
     * @since 1.0.0
     *
     * @return string Status message.
     */
    public function getStatusMessage() : string;

    /**
     * Completes the task.
     *
     * @since 1.0.0
     */
    public function complete();

    /**
     * Creates a new task from a given event and configuration.
     *
     * @since 1.0.0
     *
     * @param Event  $event  The composer event that is being handled.
     * @param Config $config Configuration object.
     * @return Task New task instance.
     */
    public static function fromEventAndConfig(Event $event, Config $config) : Task;
}
