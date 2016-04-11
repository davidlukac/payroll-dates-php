<?php

namespace davidlukac\payroll_dates;

/**
 * Class DateTimeConversionException encapsulates any input that was attempted to be converted into a DateTime.
 *
 * @package davidlukac\payroll_dates
 */
class DateTimeConversionException extends \Exception
{
    // Input object that was attempted to be converted.
    /* @var $_input mixed */
    private $_input;

    /**
     * DateTimeConversionException constructor.
     *
     * @param string $message Exception message.
     * @param mixed $input Whatever was supplied as input.
     */
    public function __construct($message, $input)
    {
        $this->_input = $input;
        // Get the input type and add it into the message.
        $was = gettype($input);
        if ($was == "object") {
            $was = get_class($input);
        }
        $message .= ' Was: ' . $was . '.';
        parent::__construct($message);
    }
}
