<?php
/**
 * Trait FelixArntz\Boilerplate\Task\GetPlaceholderValuesTrait
 *
 * @package FelixArntz\Boilerplate
 * @license GNU General Public License v2 (or later)
 * @link    https://github.com/felixarntz/boilerplate
 */

namespace FelixArntz\Boilerplate\Task;

/**
 * Trait for a class that allows getting placeholder values.
 *
 * @since 1.0.0
 */
trait GetPlaceholderValuesTrait
{

    /**
     * Gets a map of placeholders and their values.
     *
     * @since 1.0.0
     *
     * @param array $placeholdersData          Data for all placeholders.
     * @param array $generatedPlaceholdersData Data for all generated placeholders.
     * @param array $settings                  Map of $setting => $value pairs.
     * @return array Map of $placeholder => $value pairs.
     */
    protected function getPlaceholderValues(
        array $placeholdersData,
        array $generatedPlaceholdersData,
        array $settings
    ) : array
    {
        $placeholders = [];

        foreach ($placeholdersData as $key => $data) {
            $placeholders[$key] = $data['value'];
        }

        foreach ($generatedPlaceholdersData as $key => $callback) {
            $placeholders[$key] = call_user_func($callback, $placeholders, $settings);
        }

        return $placeholders;
    }

    /**
     * Gets a map of settings and their values.
     *
     * @since 1.0.0
     *
     * @param array $settingsData Data for all settings.
     * @return array Map of $setting => $value pairs.
     */
    protected function getSettingValues(array $settingsData) : array
    {
        $settings = [];

        foreach ($settingsData as $key => $data) {
            $settings[$key] = $data['value'];
        }

        return $settings;
    }
}
