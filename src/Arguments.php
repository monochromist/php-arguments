<?php
/**
 * Utility class for arguments validation
 * @author MarcosMenegazzo (https://github.com/MarcosMenegazzo)
 */
namespace monochromist;

/**
 * Utility class for arguments validation
 *
 */
abstract class Arguments
{
    /**
     * Validates argument.
     *
     * Example:
     * ... function bobIsGoingHome($arg1) { ...
     * Arguments::validate($arg1, ['String', 'array']); // will throw exception if $arg1 is not a string or array
     * @param $argument Any value
     * @param $types Array with expected types. See http://php.net/manual/en/function.gettype.php
     * @param $throwException Boolean, throws exception if argument is not the required type
     * @return True if valid, false otherwise
     */
    public static function validate($argument, $types = [], $throwException = true)
    {
        $valid = false;
        foreach ($types as $type) {
            if (strcasecmp(gettype($argument), $type) == 0) {
                $valid = true;
                break;
            }
        }
        if (!$valid && $throwException) {
            throw new \InvalidArgumentException(implode(" or ", $types) . " required. " . gettype($argument) . " given.");
        }
        return $valid;
    }

    /**
     * Checks if array is strictly associative (String key => Any value)
     * @param $array Any array
     * @param $throwException Throws exception if array is not strictly associative
     * @return True if associative, false otherwise
     */
    public static function validateAssociativeArray($array = [], $throwException = true)
    {
        $valid = self::hasStringkeys($array);
        if (!$valid) {
            throw new \InvalidArgumentException("Associate array with string keys required.");
        }
        return $valid;
    }

    /**
     * Returns true if array is only associative (String key => Any value)
     * @param $array Any array
     * @return True if associative, false otherwise
     */
    public static function hasStringKeys($array = [])
    {
        return count(array_filter(array_keys($array), 'is_string')) > 0;
    }

    /**
     * Prioritize the first non empty element from array
     * @param $args Array with arguments
     * @return mixed element value or null if all are empty
     */
    public static function prioritize($args = [])
    {
        $value = null;
        foreach ($args as $arg) {
            if (!empty($arg)) {
                $value = $arg;
                break;
            }
        }
        return $value;
    }

    /**
     * Throws exception if argument is null
     * @param $argValue Any value
     * @param $argName  Human readable name. In most cases the argument name itself.
     * @return boolean True if not null, false otherwise.
     */
    public static function notNull($argValue, $argName = '')
    {
        $valid = ($argValue !== null);
        if (!$valid) {
            $message = implode(' ', array_filter(['Argument', $argName, 'must not be null']));
            throw new \InvalidArgumentException($message);
        }
        return $valid;
    }
}
