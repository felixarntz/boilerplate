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
            $default = $this->getPlaceholderDefault($data);
            $value   = $default;

            $question = $this->getPlaceholderQuestion($data, $default);

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

    /**
     * Gets the default placeholder value for the given data.
     *
     * @since 1.0.0
     *
     * @param array $data Data for the placeholder.
     * @return mixed Placeholder default value.
     */
    protected function getPlaceholderDefault(array $data)
    {
        if (!isset($data['default'])) {
            return null;
        }

        if (is_callable($data['default'])) {
            return call_user_func($data['default'], $this->config['placeholders']);
        }

        return $data['default'];
    }

    /**
     * Gets the question to print to the user, including optional information.
     *
     * @since 1.0.0
     *
     * @param array $data    Data for the placeholder.
     * @param mixed $default Optional. Default value for the placeholder. Default null.
     * @return string Placeholder question to ask.
     */
    protected function getPlaceholderQuestion(array $data, $default = null) : string
    {
        $question = sprintf('<question>%s</question>', $data['name']);
        if (!empty($data['description'])) {
            $question .= ' [' . $data['description'] . ']';
        }
        if ($default !== null) {
            if (empty($data['choices']) && !empty($data['confirm'])) {
                $default = $default ? 'yes' : 'no';
            }
            $question .= sprintf(' <info>Default: "%s"</info>', $default);
        }
        $question .= ' ? ';

        return $question;
    }
}
