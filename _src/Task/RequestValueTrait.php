<?php
/**
 * Trait FelixArntz\Boilerplate\Task\RequestValueTrait
 *
 * @package FelixArntz\Boilerplate
 * @license GNU General Public License v2 (or later)
 * @link    https://github.com/felixarntz/boilerplate
 */

namespace FelixArntz\Boilerplate\Task;

use Composer\IO\IOInterface as IO;

/**
 * Trait for a class that requests values from the user via an input/output helper.
 *
 * @since 1.0.0
 */
trait RequestValueTrait
{
    use IOAwareTrait;

    /**
     * Requests the value for a given set of data from the user.
     *
     * @since 1.0.0
     *
     * @param array $data    Data for requesting and validating the value.
     * @param mixed $default Optional. Default value to return. Default null.
     * @return mixed Provided value.
     */
    protected function requestValue(array $data, $default = null)
    {
        $value    = $default;
        $question = $this->getValueQuestion($data, $default);

        if (!empty($data['choices'])) {
            $proceed = false;

            if ($default !== null) {
                $default = array_search($default, $data['choices'], true);
                if ($default === false) {
                    $default = key($data['choices']);
                }
            }

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
        } elseif (!empty($data['validation'])) {
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

        return $value;
    }

    /**
     * Gets the question to print to the user, including optional information.
     *
     * @since 1.0.0
     *
     * @param array $data    Data for requesting and validating the value.
     * @param mixed $default Optional. Default value to return. Default null.
     * @return string Question to ask.
     */
    protected function getValueQuestion(array $data, $default = null) : string
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
