<?php

namespace davidlukac\payroll_dates\tests;

use davidlukac\payroll_dates\SalaryMonth;
use davidlukac\payroll_dates\YearMonth;
use ICanBoogie\DateTime as iDateTime;

class SalaryMonthTest extends \PHPUnit_Framework_TestCase
{
    public function testSalaryDateCalculations()
    {
        $sm = new SalaryMonth(new YearMonth(2016, 4));
        $this->assertEquals(new iDateTime("2016-04-29 00:00:00"), $sm->getSalaryDate());

        $sm = new SalaryMonth(new YearMonth(2016, 3));
        $this->assertEquals(new iDateTime("2016-03-31 00:00:00"), $sm->getSalaryDate());

        $sm = new SalaryMonth(new YearMonth(2016, 8));
        $this->assertEquals(new iDateTime("2016-08-31 00:00:00"), $sm->getSalaryDate());

        $sm = new SalaryMonth(new YearMonth(2016, 1));
        $this->assertEquals(new iDateTime("2016-01-29 00:00:00"), $sm->getSalaryDate());

        $sm = new SalaryMonth(new YearMonth(2016, 12));
        $this->assertEquals(new iDateTime("2016-12-30 00:00:00"), $sm->getSalaryDate());

        $sm = new SalaryMonth(new YearMonth(2017, 4));
        $this->assertEquals(new iDateTime("2017-04-28 00:00:00"), $sm->getSalaryDate());

        $sm = new SalaryMonth(new YearMonth(2017, 6));
        $this->assertEquals(new iDateTime("2017-06-30 00:00:00"), $sm->getSalaryDate());

        $sm = new SalaryMonth(new YearMonth(2008, 11));
        $this->assertEquals(new iDateTime("2008-11-28 00:00:00"), $sm->getSalaryDate());
    }

    public function testBonusDateCalculation()
    {
        $sm = new SalaryMonth(new YearMonth(2016, 2));
        $this->assertEquals(new iDateTime("2016-03-15 00:00:00"), $sm->getBonusDate());

        $sm = new SalaryMonth(new YearMonth(2012, 11));
        $this->assertEquals(new iDateTime("2012-12-19 00:00:00"), $sm->getBonusDate());

        $sm = new SalaryMonth(new YearMonth(2022, 4));
        $this->assertEquals(new iDateTime("2022-05-18 00:00:00"), $sm->getBonusDate());

        $sm = new SalaryMonth(new YearMonth(2017, 12));
        $this->assertEquals(new iDateTime("2018-01-15 00:00:00"), $sm->getBonusDate());
    }

}
