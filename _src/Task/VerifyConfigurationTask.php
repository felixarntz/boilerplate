<?php
/**
 * Class FelixArntz\Boilerplate\Task\VerifyConfigurationTask
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
                if (isset($data['skip'])) {
                    if (is_callable($data['skip'])) {
                        if (call_user_func($data['skip'], $this->config['settings'])) {
                            continue;
                        }
                    } elseif ($data['skip']) {
                        continue;
                    }
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
            throw new Exception('Project configuration not confirmed.');
        }
    }
}
