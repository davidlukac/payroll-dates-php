<?php

namespace davidlukac\payroll_dates;

use ICanBoogie\DateTime as iDateTime;

class YearMonth
{
    /* @var $dateTime iDateTime */
    private $_dateTime;

    /**
     * YearMonth constructor, using year and month numbers to create
     * the instance; e.g. 2016, 04.
     *
     * @param $year int
     * @param $month int
     */
    public function __construct($year, $month)
    {
        $this->_dateTime = new iDateTime("{$year}-{$month}-01 00:00:00", date_default_timezone_get());
    }

    /**
     * An alternative constructor that takes a \DateTime as argument.
     *
     * @param \DateTime $dt
     *
     * @return \davidlukac\payroll_dates\YearMonth
     */
    public static function constructWithDate(\DateTime $dt)
    {
        $instance = new self($dt->format('Y'), $dt->format('m'));
        $instance->_dateTime = new iDateTime($dt->format('Y-m') . '-01 00:00:00', date_default_timezone_get());
        return $instance;
    }

    /**
     * Year as a number, e.g. 2012.
     *
     * @return int
     */
    public function getYear()
    {
        return $this->_dateTime->year;
    }

    /**
     * Number of month of the YearMonth instance, within the year boundaries.
     *
     * @return int
     */
    public function getMonth()
    {
        return $this->_dateTime->month;
    }

    public function getDateTime()
    {
        return $this->_dateTime;
    }

    /**
     * Return formatted year-month.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getYear() . '-' . sprintf('%02d', $this->getMonth());
    }
}
