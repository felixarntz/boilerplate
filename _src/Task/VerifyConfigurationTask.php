<?php
/**
 * Class FelixArntz\Boilerplate\Task\VerifyConfigurationTask
 *
 * @package FelixArntz\Boilerplate
 * @license GNU General Public License, version 2
 * @link    https://github.com/felixarntz/boilerplate
 */

namespace FelixArntz\Boilerplate\Task;

use RuntimeException;

/**
 * Class representing a task that asks the user to provide values for config placeholders.
 *
 * @since 1.0.0
 */
class VerifyConfigurationTask extends AbstractTask implements ConfigAware, IOAware
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
        return 'Verifying configuration...';
    }

    /**
     * Completes the task.
     *
     * @since 1.0.0
     *
     * @throws RuntimeException Thrown when the user does not confirm the configuration.
     */
    public function complete()
    {
        if (!empty($this->config['placeholders'])) {
            foreach ($this->config['placeholders'] as $data) {
                $this->io->write(
                    sprintf(
                        '%1$s: <info>%2$s</info>',
                        $data['name'],
                        $data['value']
                    )
                );
            }
        }

        if (!empty($this->config['settings'])) {
            foreach ($this->config['settings'] as $data) {
                if ($this->shouldSkipSetting($data)) {
                    continue;
                }

                $value = $data['value'];
                if (is_bool($value)) {
                    $value = $value ? 'yes' : 'no';
                }

                $this->io->write(
                    sprintf(
                        '%1$s: <info>%2$s</info>',
                        $data['name'],
                        $value
                    )
                );
            }
        }

        $value = $this->io->askConfirmation('<question>Confirm?</question>', true);
        if (!$value) {
            throw new RuntimeException('Project configuration not confirmed.');
        }
    }

    /**
     * Checks whether verifying the setting value for the given data should be skipped.
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
}
