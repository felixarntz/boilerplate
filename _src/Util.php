<?php
/**
 * Class FelixArntz\Boilerplate\Util
 *
 * @package FelixArntz\Boilerplate
 * @license GNU General Public License, version 2
 * @link    https://github.com/felixarntz/boilerplate
 */

namespace FelixArntz\Boilerplate;

/**
 * Class containing static utility methods.
 *
 * @since 1.0.0
 */
class Util
{

    /**
     * Transforms a regular human-readable name to hyphen-case.
     *
     * @since 1.0.0
     *
     * @param string $name Input name. Is not checked against invalid characters.
     * @return string Name in hyphen-case.
     */
    public static function toHyphenCase(string $name) : string
    {
        return str_replace(' ', '-', strtolower($name));
    }

    /**
     * Transforms a regular human-readable name to underscore-case.
     *
     * @since 1.0.0
     *
     * @param string $name Input name. Is not checked against invalid characters.
     * @return string Name in underscore-case.
     */
    public static function toUnderscoreCase(string $name) : string
    {
        return str_replace(' ', '_', strtolower($name));
    }

    /**
     * Transforms a regular human-readable name to Pascal-case.
     *
     * @since 1.0.0
     *
     * @param string $name Input name. Is not checked against invalid characters.
     * @return string Name in Pascal-case.
     */
    public static function toPascalCase(string $name) : string
    {
        return str_replace(' ', '', ucwords($name));
    }

    /**
     * Transforms a regular human-readable name to camel-case.
     *
     * @since 1.0.0
     *
     * @param string $name Input name. Is not checked against invalid characters.
     * @return string Name in camel-case.
     */
    public static function toCamelCase(string $name) : string
    {
        return lcfirst(static::toPascalCase($name));
    }

    /**
     * Generates an array with a range of version numbers.
     *
     * @since 1.0.0
     *
     * @param string $start     Version number to start with.
     * @param string $end       Version number to end with. Must be greater or equal than $start.
     * @param string $precision Optional. Precision for increasing version numbers. Either 'major', 'minor',
     *                          or 'patch'. Default 'minor'.
     * @return array Range of version numbers.
     */
    public static function versionRange(string $start, string $end, string $precision = 'minor') : array
    {
        switch ($precision) {
            case 'major':
                $decimals = 1;
                break;
            case 'patch':
                $decimals = 3;
                break;
            default:
                $decimals = 2;
        }

        $start = implode('.', array_slice(explode('.', $start), 0, $decimals));
        $end   = implode('.', array_slice(explode('.', $end), 0, $decimals));

        $range = [];
        while (version_compare($start, $end, '<=')) {
            $range[] = $start;

            $start = (int) str_replace('.', '', $start) + 1;
            $start = str_split((string) $start);
            if (count($start) > $decimals) {
                $start = array_shift($start) . implode('.', $start);
            } else {
                $start = implode('.', $start);
            }
        }

        return $range;
    }
}
