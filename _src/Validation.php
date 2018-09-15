<?php
/**
 * Class FelixArntz\Boilerplate\Validation
 *
 * @package FelixArntz\Boilerplate
 * @license GNU General Public License, version 2
 * @link    https://github.com/felixarntz/boilerplate
 */

namespace FelixArntz\Boilerplate;

use InvalidArgumentException;

/**
 * Class containing static validation methods.
 *
 * @since 1.0.0
 */
class Validation
{

    /**
     * Validates a name, consisting of only alphanumeric characters, hyphens and spaces.
     *
     * @since 1.0.0
     *
     * @param string $name String to validate.
     * @return string Validated string.
     *
     * @throws InvalidArgumentException Thrown if the string is invalid.
     */
    public static function validateName(string $name) : string
    {
        $name = trim($name);

        if (!preg_match('/^[A-Za-z0-9\- ]+$/', $name)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Provided string "%s" contains invalid characters.',
                    $name
                )
            );
        }

        return $name;
    }

    /**
     * Validates a description, consisting of only alphanumeric characters, commas, hyphens and spaces and ending in a dot.
     *
     * @since 1.0.0
     *
     * @param string $description String to validate.
     * @return string Validated string.
     *
     * @throws InvalidArgumentException Thrown if the string is invalid.
     */
    public static function validateDescription(string $description) : string
    {
        $description = trim($description);

        if (!preg_match('/^[A-Za-z0-9,\- ]+\.$/', $description)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Provided string "%s" contains invalid characters or does not end in dot.',
                    $description
                )
            );
        }

        return $description;
    }

    /**
     * Validates a list of comma-separated slugs, each of which must only contain alphanumeric characters.
     *
     * @since 1.0.0
     *
     * @param string $slugs String to validate.
     * @return string Validated string.
     *
     * @throws InvalidArgumentException Thrown if the string is invalid.
     */
    public static function validateSlugList(string $slugs) : string
    {
        $slugs = trim($slugs);
        $slugs = preg_split('/[\s,]+/', $slugs, -1, PREG_SPLIT_NO_EMPTY);
        $slugs = array_filter($slugs);

        foreach ($slugs as $slug) {
            if (!preg_match('/^[A-Za-z0-9]+$/', $slug)) {
                throw new InvalidArgumentException(
                    sprintf(
                        'Slug "%s" in the provided string contains invalid characters.',
                        $slug
                    )
                );
            }
        }

        return implode(',', $slugs);
    }

    /**
     * Validates a URL.
     *
     * @since 1.0.0
     *
     * @param string $url String to validate.
     * @return string Validated string.
     *
     * @throws InvalidArgumentException Thrown if the string is invalid.
     */
    public static function validateURL(string $url) : string
    {
        $url = trim($url);

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Provided string "%s" is not a valid URL.',
                    $url
                )
            );
        }

        return $url;
    }

    /**
     * Validates an email address.
     *
     * @since 1.0.0
     *
     * @param string $email String to validate.
     * @return string Validated string.
     *
     * @throws InvalidArgumentException Thrown if the string is invalid.
     */
    public static function validateEmail(string $email) : string
    {
        $email = trim($email);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Provided string "%s" is not a valid email address.',
                    $email
                )
            );
        }

        return $email;
    }
}
