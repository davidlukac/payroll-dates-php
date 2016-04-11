<?php

namespace davidlukac\payroll_dates;

use Symfony\Component\Console\Application;

/**
 * Class PayrollDatesApp - actual application class.
 *
 * Contains application setup and functions that invoke core functionality:
 * - calculateForNextYear() - calculates salary and bonus dates for the next twelve months.
 *
 * Entry point for the application is 'getInstance()' function.
 *
 * @package davidlukac\payroll_dates
 */
class PayrollDatesApp
{

    // @todo Make timezone configurable.
    private $_appTimeZoneID = "Europe/London";
    /* @var $_appTimeZone \DateTimeZone */
    private $_appTimeZone;
    /* @var $_consoleApp Application */
    private $_consoleApp;

    /**
     * PayrollDatesApp constructor - application setup.
     */
    private function __construct()
    {
        $this->_appTimeZone = new \DateTimeZone($this->_appTimeZoneID);
        date_default_timezone_set($this->_appTimeZone->getName());
    }

    /**
     * Entry function for the application.
     *
     * @return \davidlukac\payroll_dates\PayrollDatesApp
     */
    public static function getInstance()
    {
        return new PayrollDatesApp();
    }

    /**
     * Provides console application representation.
     *
     * @return \Symfony\Component\Console\Application
     */
    public function getConsoleApp()
    {
        if (false === isset($this->_consoleApp)) {
            $consoleApp = new Application();
            $consoleApp->setName("Payroll Dates Calculator");
            $consoleApp->setVersion("v0.1.0");
            $consoleApp->add(new CalculateCommand());
            $this->_consoleApp = $consoleApp;
        }
        return $this->_consoleApp;
    }

    /**
     * Retrieves salary dates for the next year from "now".
     *
     * @return array of SalaryMonth objects.
     */
    public function calculateForNextYear()
    {
        // Start with current date.
        $immutableStart = new \DateTimeImmutable("now", $this->getTimeZone());
        // Initialise result array of SalaryMonth-s.
        $calculatedYearInterval = array();
        // Calculate and store for the next year.
        for ($i = 0; $i < 12; $i++) {
            $calculatedYearInterval[$i] = new SalaryMonth(
                YearMonth::constructWithDate(
                    \DateTime::createFromFormat('U', $immutableStart->add(new \DateInterval("P{$i}M"))->getTimestamp())
                )
            );
        }
        return $calculatedYearInterval;
    }

    /**
     * Helper function to provide timezone in the application context.
     *
     * @return \DateTimeZone of the application.
     */
    public function getTimeZone()
    {
        return $this->_appTimeZone;
    }

}
