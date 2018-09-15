<?php
/**
 * Class FelixArntz\Boilerplate\Task\RequestPlaceholderValuesTask
 *
 * @package FelixArntz\Boilerplate
 * @license GNU General Public License, version 2
 * @link    https://github.com/felixarntz/boilerplate
 */

namespace FelixArntz\Boilerplate\Task;

use Exception;

/**
 * Class representing a task that asks the user to provide values for config placeholders.
 *
 * @since 1.0.0
 */
class RequestPlaceholderValuesTask extends AbstractTask implements ConfigAware, IOAware
{
    use ConfigAwareTrait, IOAwareTrait;

    /**
     * Gets the initial status message to show before the task starts execution.
     *
     * @since 1.0.0
     *
     * @return string Status message.
     */
    public function getStatusMessage() : string
    {
        return 'Requesting placeholder values...';
    }

    /**
     * Completes the task.
     *
     * @since 1.0.0
     */
    public function complete()
    {
        if (empty($this->config['placeholders'])) {
            return;
        }

        foreach ($this->config['placeholders'] as $key => $data) {
            $default = null;
            if (!empty($data['default'])) {
                $default = $data['default'];
                if (is_callable($default)) {
                    $default = call_user_func($default, $this->config['placeholders']);
                }
            }

            $value = $default;

            $question = sprintf('<question>%s</question>', $data['name']);
            if (!empty($data['description'])) {
                $question .= ' [' . $data['description'] . ']';
            }
            if ($default) {
                $question .= sprintf(' <info>Default: "%s"</info>', $default);
            }
            $question .= ' ? ';

            if (!empty($data['validation'])) {
                $proceed = false;

                do {
                    try {
                        $value   = $this->io->askAndValidate($question, $data['validation'], null, $default);
                        $proceed = true;
                    } catch (Exception $e) {
                        $this->io->writeError(sprintf('<warning>%s</warning>', $e->getMessage()));
                    }
                } while (!$proceed);
            } else {
                $value = $this->io->ask($question, $default);
            }

            $this->config['placeholders'][$key]['value'] = $value;
        }
    }
}
