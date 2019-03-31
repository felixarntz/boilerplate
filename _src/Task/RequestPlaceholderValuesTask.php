<?php
/**
 * Class FelixArntz\Boilerplate\Task\RequestPlaceholderValuesTask
 *
 * @package FelixArntz\Boilerplate
 * @license GNU General Public License v2 (or later)
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
    use ConfigAwareTrait, RequestValueTrait;

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

            $this->config['placeholders'][$key]['value'] = $this->requestValue($data, $default);
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
}
