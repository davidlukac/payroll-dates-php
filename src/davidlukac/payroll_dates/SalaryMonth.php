<?php

namespace davidlukac\payroll_dates;

use ICanBoogie\DateTime as iDateTime;

/**
 * Class SalaryMonth is the core class of the application. It holds year-month representation of a month and its
 * salary and bonus dates.
 *
 * @package davidlukac\payroll_dates
 */
class SalaryMonth
{
    /* @var $_yearMonth YearMonth */
    private $_yearMonth;
    /* @var $_salaryDate iDateTime */
    private $_salaryDate;
    /* @var $_bonusDate iDateTime */
    private $_bonusDate;

    /**
     * SalaryMonth constructor.
     *
     * @param $calendarMonth YearMonth
     */
    public function __construct(YearMonth $calendarMonth)
    {
        $this->_yearMonth = $calendarMonth;
    }

    /**
     * Calculates and returns date of salary.
     *
     * @return \ICanBoogie\DateTime calculated date.
     */
    public function getSalaryDate()
    {
        if ($this->_salaryDate == NULL) {
            // Calculate the salary date for the first time.
            $this->_salaryDate = $this->calculateSalaryDate($this->_yearMonth);
        }
        return $this->_salaryDate;
    }

    /**
     * Calculates and returns date of the bonus.
     *
     * @return \ICanBoogie\DateTime calculated date.
     */
    public function getBonusDate()
    {
        if ($this->_bonusDate == NULL) {
            // Calculate the bonus for the first time.
            $this->_bonusDate = $this->calculateBonusDate($this->_yearMonth);
        }
        return $this->_bonusDate;
    }

    /**
     * Calculates salary pay date from YearMonth.
     *
     * @param \davidlukac\payroll_dates\YearMonth $month
     *
     * @return \ICanBoogie\DateTime calculated salary pay date.
     */
    private function calculateSalaryDate(YearMonth $month)
    {
        // Calculate last day of month.
        $lastDay = $this->calculateLastDayOfMonth($month);

        // Get day of week for the last day of given month.
        /* @var $dayOfWeek integer */
        $dayOfWeek = $lastDay->weekday;

        // If it is weekend, recalculate to Friday before.
        if ($dayOfWeek === 6) {
            $subtractDays = new \DateInterval("P1D");
        } elseif ($dayOfWeek === 7) {
            $subtractDays = new \DateInterval("P2D");
        } else {
            $subtractDays = new \DateInterval("P0D");
        }

        return DateUtils::to_iDate($lastDay->sub($subtractDays));
    }

    /**
     * Calculates bonus pay date for given YearMonth.
     *
     * @param \davidlukac\payroll_dates\YearMonth $month
     *
     * @return \ICanBoogie\DateTime calculated bonys pay date.
     *
     * @throws \davidlukac\payroll_dates\DateTimeConversionException
     */
    private function calculateBonusDate(YearMonth $month)
    {
        /* @var $lastDay iDateTime */
        $lastDay = $this->calculateLastDayOfMonth($month);
        $delay = new \DateInterval("P15D");
        /* @var $bonusDate iDateTime */
        $bonusDate = $lastDay->add($delay);

        // Get day of week for the bonus day.
        /* @var $dayOfWeek integer */
        $dayOfWeek = $bonusDate->weekday;

        // If it is weekend, recalculate to Friday before.
        if ($dayOfWeek === 6) {
            $addDays = new \DateInterval("P4D");
        } elseif ($dayOfWeek === 7) {
            $addDays = new \DateInterval("P3D");
        } else {
            $addDays = new \DateInterval("P0D");
        }

        return DateUtils::to_iDate($bonusDate->add($addDays));
    }

    /**
     * Helper function to calculate last day of month for given YearMonth.
     *
     * @todo Refactor to DateUtils as reusable functionality.
     *
     * @param \davidlukac\payroll_dates\YearMonth $month
     *
     * @return \ICanBoogie\DateTime
     * @throws \davidlukac\payroll_dates\DateTimeConversionException
     */
    private function calculateLastDayOfMonth(YearMonth $month)
    {
        // Calculate last day of month.
        $lastDayString = \DateTime::createFromFormat('Y-m-d', $month->getDateTime()->as_date)->format('Y-m-t');
        $dt = \DateTime::createFromFormat('Y-m-d', $lastDayString);
        /* @var $lastDay iDateTime */
        $lastDay = DateUtils::to_iDate($dt);
        return $lastDay;
    }

    /**
     * Nicely formatted string with month, salary and bonus date information.
     *
     * @return string
     */
    public function __toString()
    {
        $s = 'For month ' . $this->_yearMonth . ', salary is paid on '
            . $this->getSalaryDate()->format_as_date() . ' and bonuses are paid on '
            . $this->getBonusDate()->as_date . '.';
        return $s;
    }

    /**
     * Helper function that provides header of the output CSV file as array of strings - names of the columns.
     *
     * @return array
     */
    public static function getCsvHeader()
    {
        return ['Month', 'MonthName', 'SalaryDate', 'BonusDate'];
    }

    /**
     * Helper function providing class data as string in an array as follows:
     * - year and month in format 'Y-m', e.g. 2016-04,
     * - name of the month as long string, e.g. April,
     * - salary date as string in format 'Y-m-d', e.g. 2016-04-29,
     * - bonus date as string in format 'Y-m-d', e.g. 2016-05-18.
     *
     * @return array
     */
    public function getCsvFields()
    {
        $ar = [
            $this->_yearMonth->__toString(),
            $this->_yearMonth->getDateTime()->format('F'),
            $this->getSalaryDate()->as_date,
            $this->getBonusDate()->as_date
        ];
        return $ar;
    }

}
