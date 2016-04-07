<?php

namespace spec\davidlukac\payroll_dates;

use davidlukac\payroll_dates\PayrollDatesApp;
use ICanBoogie\DateTime;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class YearMonthSpec extends ObjectBehavior
{
    /* @var $appContext PayrollDatesApp */
    private $_appContext;

    public function __construct()
    {
        $this->_appContext = PayrollDatesApp::getInstance();
    }

    function it_should_be_constructed_with_year_month()
    {
        $this->beConstructedWith(2016, 4);
        $this->getYear()->shouldReturn(2016);
        $this->getMonth()->shouldReturn(4);
        $this->shouldHaveType('davidlukac\payroll_dates\YearMonth');
    }

    function it_should_provide_datetime_representation()
    {
        $year = 2016;
        $month = 4;
        $this->beConstructedWith($year, $month);
        $this->getDateTime()->shouldBeLike(
            new DateTime("{$year}-{$month}-01 01:01:01", $this->_appContext->getTimeZone())
        );
    }
}
