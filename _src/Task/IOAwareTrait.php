<?php
/**
 * Trait FelixArntz\Boilerplate\Task\IOAwareTrait
 *
 * @package FelixArntz\Boilerplate
 * @license GNU General Public License, version 2
 * @link    https://github.com/felixarntz/boilerplate
 */

namespace FelixArntz\Boilerplate\Task;

use Composer\IO\IOInterface as IO;

/**
 * Trait for something that is aware of a input/output helper.
 *
 * @since 1.0.0
 */
trait IOAwareTrait
{

    /**
     * Input/output helper.
     *
     * @since 1.0.0
     * @var IO
     */
    protected $io;

    /**
     * Sets the input/output helper.
     *
     * @since 1.0.0
     *
     * @param IO $io Input/output helper.
     */
    public function setIO(IO $io)
    {
        $this->io = $io;
    }

    /**
     * Gets the input/output helper.
     *
     * @since 1.0.0
     *
     * @return IO Input/output helper.
     */
    public function getIO() : IO
    {
        return $this->io;
    }
}
