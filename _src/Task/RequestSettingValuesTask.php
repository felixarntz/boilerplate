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
            if ($this->shouldSkipSetting($data)) {
                $this->config['settings'][$key]['value'] = $this->getSettingDefault($data);
                continue;
            }

            $default = $this->getSettingDefault($data);
            $value   = $default;

            $question = $this->getSettingQuestion($data, $default);

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

    /**
     * Checks whether requesting the setting value for the given data should be skipped.
     *
     * @since 1.0.0
     *
     * @param array $data Data for the setting.
     * @return bool True if the setting should be skipped, false otherwise.
     */
    protected function shouldSkipSetting(array $data) : bool
    {
        if (!isset($data['skip'])) {
            return false;
        }

        if (is_callable($data['skip'])) {
            return (bool) call_user_func($data['skip'], $this->config['settings']);
        }

        return (bool) $data['skip'];
    }

    /**
     * Gets the default setting value for the given data.
     *
     * @since 1.0.0
     *
     * @param array $data Data for the setting.
     * @return mixed Setting default value.
     */
    protected function getSettingDefault(array $data)
    {
        if (!isset($data['default'])) {
            return null;
        }

        if (is_callable($data['default'])) {
            return call_user_func($data['default'], $this->config['settings']);
        }

        return $data['default'];
    }

    /**
     * Gets the question to print to the user, including optional information.
     *
     * @since 1.0.0
     *
     * @param array $data    Data for the setting.
     * @param mixed $default Optional. Default value for the setting. Default null.
     * @return string Setting question to ask.
     */
    protected function getSettingQuestion(array $data, $default = null) : string
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
