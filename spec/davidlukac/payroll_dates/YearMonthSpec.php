<?php

namespace spec\davidlukac\payroll_dates;

use spec\davidlukac\payroll_dates\PayrollDatesAppBehaviour as AppBehaviour;
use ICanBoogie\DateTime as iDateTime;
use Prophecy\Argument;

class YearMonthSpec extends AppBehaviour
{
    function it_should_be_constructed_with_year_month()
    {
        $this->beConstructedWith(2016, 4);
        $this->getYear()->shouldReturn(2016);
        $this->getMonth()->shouldReturn(4);
        $this->shouldHaveType('davidlukac\payroll_dates\YearMonth');
    }

    function it_should_be_constructed_with_datetime()
    {
        $this->beConstructedThrough('constructWithDate', array(new iDateTime("2016-04-08 01:02:03")));
        $this->getDateTime()->shouldBeLike(
            new iDateTime("2016-04-01 00:00:00", $this->_appContext->getTimeZone())
        );
    }

    function it_should_provide_datetime_representation()
    {
        $year = 2016;
        $month = 4;
        $this->beConstructedWith($year, $month);
        $this->getDateTime()->shouldBeLike(
            new iDateTime("{$year}-{$month}-01 00:00:00", $this->_appContext->getTimeZone())
        );
    }

    function it_should_print_year_month()
    {
        $this->beConstructedWith(2016, 4);
        $this->__toString()->shouldBeLike("2016-04");
    }
}
