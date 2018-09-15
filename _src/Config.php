<?php
/**
 * Class FelixArntz\Boilerplate\Config
 *
 * @package FelixArntz\Boilerplate
 * @license GNU General Public License, version 2
 * @link    https://github.com/felixarntz/boilerplate
 */

namespace FelixArntz\Boilerplate;

use ArrayObject;
use InvalidArgumentException;
use RuntimeException;

/**
 * Class containing setup configuration data.
 *
 * @since 1.0.0
 */
class Config extends ArrayObject
{

    /**
     * Constructor.
     *
     * Sets the configuration array.
     *
     * @since 1.0.0
     *
     * @param array $config Associative array with configuration data.
     */
    public function __construct(array $config)
    {
        parent::__construct($config, ArrayObject::ARRAY_AS_PROPS);
    }

    /**
     * Gets the value for a given key from the configuration.
     *
     * @since 1.0.0
     *
     * @param string ...$keypath One or more nested keys to get the value.
     * @return mixed Found value.
     *
     * @throws InvalidArgumentException Thrown when the key does not exist.
     */
    public function get(string ...$keypath)
    {
        if (count($keypath) === 1) {
            if (!$this->offsetExists($keypath[0])) {
                throw new InvalidArgumentException(
                    sprintf(
                        'The configuration key "%s" does not exist.',
                        implode(' -> ', $keypath)
                    )
                );
            }

            return $this->offsetGet($keypath[0]);
        }

        $keys = array_reverse($keypath);
        $arr  = $this->getArrayCopy();
        while (count($keys) > 0) {
            $key = array_pop($keys);
            if (!isset($arr[$key])) {
                throw new InvalidArgumentException(
                    sprintf(
                        'The configuration key "%s" does not exist.',
                        implode(' -> ', $keypath)
                    )
                );
            }

            $arr = $arr[$key];
        }

        return $arr;
    }

    /**
     * Checks whether a given key exists in the configuration.
     *
     * @since 1.0.0
     *
     * @param string ...$keypath One or more nested keys to check for.
     * @return bool True if the key exists, false otherwise.
     */
    public function has(string ...$keypath) : bool
    {
        try {
            $this->get(...$keypath);
        } catch (InvalidArgumentException $e) {
            return false;
        }

        return true;
    }

    /**
     * Gets the entire configuration as an associative array.
     *
     * @since 1.0.0
     *
     * @return array Associative array with configuration data.
     */
    public function getAll() : array
    {
        return $this->getArrayCopy();
    }

    /**
     * Creates a new configuration object with the value for a given key as its root.
     *
     * @since 1.0.0
     *
     * @param string ...$keypath One or more nested keys to use its value as root.
     * @return Config New configuration object.
     *
     * @throws InvalidArgumentException Thrown if the value at the given key is not valid as a configuration array.
     */
    public function getSubConfig(string ...$keypath) : Config
    {
        $newData = $this->get(...$keypath);
        if (!is_array($newData) || $newData === array_values($newData)) {
            throw new InvalidArgumentException(
                sprintf(
                    'The value at configuration key "%s" is not valid as a configuration array.',
                    implode(' -> ', $keypath)
                )
            );
        }

        $subConfig = clone $this;
        $subConfig->exchangeArray($newData);

        return $subConfig;
    }

    /**
     * Creates a new configuration object from a file containing configuration data.
     *
     * @since 0.2
     *
     * @param string $fileName Absolute path to the file containing configuration data. Valid formats
     *                         are .php and .json.
     * @return Config New configuration object.
     *
     * @throws InvalidArgumentException Thrown when the file does not exist or has an invalid extension.
     * @throws RuntimeException         Thrown when the file cannot be read or contains invalid data.
     */
    public static function fromFile(string $fileName) : Config
    {
        if (!file_exists($fileName)) {
            throw new InvalidArgumentException(sprintf('File "%s" does not exist.', $fileName));
        }

        $fileExtension = preg_match('/\.([a-z]+)$/', $fileName, $matches);
        if ($fileExtension) {
            $fileExtension = $matches[1];
        }

        switch ($fileExtension) {
            case 'json':
                $config = file_get_contents($fileName);
                if ($config === false) {
                    throw new RuntimeException(sprintf('File "%s" cannot be read.', $fileName));
                }

                $config = json_decode($config, true);
                break;
            case 'php':
                $config = require $fileName;
                break;
            default:
                throw new InvalidArgumentException(sprintf('File "%s" has an invalid extension.', $fileName));
        }

        if (!is_array($config)) {
            throw new RuntimeException(sprintf('File "%s" does not contain data in a valid format.', $fileName));
        }

        return new static($config);
    }
}
