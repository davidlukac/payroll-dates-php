<?php

namespace davidlukac\payroll_dates;

use ICanBoogie\DateTime as iDateTime;

/**
 * Class DateUtils provides useful helper functions for work with DateTime objects.
 *
 * @package davidlukac\payroll_dates
 */
class DateUtils
{
    /**
     * Convert PHP DateTime to \ICanBoogie\DateTime
     *
     * Respects provided timezone.
     *
     * @param \DateTime $dt
     *
     * @return iDateTime New, converted DateTime instance.
     */
    public static function to_iDateTime(\DateTime $dt)
    {
        return new iDateTime($dt->format('Y-m-d H:i:s'), $dt->getTimezone());
    }

    /**
     * Convert PHP DateTime to \ICanBoogie\DateTime taking only date into consideration.
     *
     * Respects provided timezone.
     *
     * @param \DateTime $dt
     *
     * @return \ICanBoogie\DateTime New, converted DateTime instance.
     *
     * @throws DateTimeConversionException when DateTime is not provided.
     */
    public static function to_iDate(\DateTime $dt)
    {
        if (($dt == null) || (false == ($dt instanceof \DateTime))) {
            throw new DateTimeConversionException("DateTime instance must be supplied.", $dt);
        }
        // We are only interested in the date - reset the time to zeroes, so comparing of dates works correctly.
        $dt->setTime(0, 0, 0);
        return new iDateTime($dt->format('Y-m-d H:i:s'), $dt->getTimezone());
    }
}
