<?php

namespace davidlukac\payroll_dates;

class PayrollDatesApp
{

    // @todo Make timezone more configuratble.
    private $_appTimeZoneID = "Europe/London";
    /* @var $_appTimeZone \DateTimeZone */
    private $_appTimeZone;

    private function __construct()
    {
        $this->_appTimeZone = new \DateTimeZone($this->_appTimeZoneID);
        date_default_timezone_set($this->_appTimeZone->getName());
    }

    public static function getInstance()
    {
        return new PayrollDatesApp();
    }

    public function calculate()
    {
        $sm = new SalaryMonth("2016-04");
    }

    /**
     * @return \DateTimeZone of the application.
     */
    public function getTimeZone()
    {
        return $this->_appTimeZone;
    }

}
