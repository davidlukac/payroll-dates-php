<?php

namespace spec\davidlukac\payroll_dates;

use davidlukac\payroll_dates\SalaryMonth;
use davidlukac\payroll_dates\YearMonth;
use ICanBoogie\DateTime as iDateTime;
use Prophecy\Argument;

class SalaryMonthSpec extends PayrollDatesAppBehaviour
{
    private $_yearMonth;

    function let()
    {
        $this->_yearMonth = new YearMonth(2016, 4);
        $this->beConstructedWith($this->_yearMonth);
    }

    function it_is_initializable()
    {
        $this->beConstructedWith($this->_yearMonth);
        $this->shouldHaveType('davidlukac\payroll_dates\SalaryMonth');
    }

    function it_calculates_salary_date()
    {
        $this->getSalaryDate()->shouldBeLike(
            new iDateTime("2016-04-29 00:00:00", $this->_appContext->getTimeZone())
        );
    }

    function it_calculates_bonus_date()
    {
        $this->getBonusDate()->shouldBeLike(
            new iDateTime("2016-05-18 00:00:00", $this->_appContext->getTimeZone())
        );
    }
}
