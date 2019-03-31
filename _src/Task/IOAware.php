<?php
/**
 * Interface FelixArntz\Boilerplate\Task\IOAware
 *
 * @package FelixArntz\Boilerplate
 * @license GNU General Public License v2 (or later)
 * @link    https://github.com/felixarntz/boilerplate
 */

namespace FelixArntz\Boilerplate\Task;

use Composer\IO\IOInterface as IO;

/**
 * Interface for something that is aware of an input/output helper.
 *
 * @since 1.0.0
 */
interface IOAware
{

    /**
     * Sets the input/output helper.
     *
     * @since 1.0.0
     *
     * @param IO $io Input/output helper.
     */
    public function setIO(IO $io);

    /**
     * Gets the input/output helper.
     *
     * @since 1.0.0
     *
     * @return IO Input/output helper.
     */
    public function getIO() : IO;
}
