<?php
/**
 * Class FelixArntz\Boilerplate\Task\RequestSettingValuesTask
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
class RequestSettingValuesTask extends AbstractTask implements ConfigAware, IOAware
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
        return 'Requesting setting values...';
    }

    /**
     * Completes the task.
     *
     * @since 1.0.0
     */
    public function complete()
    {
        if (empty($this->config['settings'])) {
            return;
        }

        foreach ($this->config['settings'] as $key => $data) {
            if (isset($data['skip'])) {
                if (is_callable($data['skip'])) {
                    if (call_user_func($data['skip'], $this->config['settings'])) {
                        continue;
                    }
                } elseif ($data['skip']) {
                    continue;
                }
            }

            $default = null;
            if (!empty($data['default'])) {
                $default = $data['default'];
                if (is_callable($default)) {
                    $default = call_user_func($default, $this->config['settings']);
                }
            }

            $value = $default;

            $question = sprintf('<question>%s</question>', $data['name']);
            if (!empty($data['description'])) {
                $question .= ' [' . $data['description'] . ']';
            }
            if ($default) {
                if (empty($data['choices']) && !empty($data['confirm'])) {
                    $question .= ' <info>Default: "yes"</info>';
                } else {
                    $question .= sprintf(' <info>Default: "%s"</info>', $default);
                }
            }
            $question .= ' ? ';

            if (!empty($data['choices'])) {
                $proceed = false;
                $default = array_search($default, $data['choices'], true);

                do {
                    try {
                        $value   = $this->io->select($question, $data['choices'], $default);
                        $value   = $data['choices'][$value];
                        $proceed = true;
                    } catch (Exception $e) {
                        $this->io->writeError(sprintf('<warning>%s</warning>', $e->getMessage()));
                    }
                } while (!$proceed);
            } elseif (!empty($data['confirm'])) {
                $value = $this->io->askConfirmation($question, $default);
            } else {
                $value = $this->io->ask($question, $default);
            }

            $this->config['settings'][$key]['value'] = $value;
        }
    }
}
