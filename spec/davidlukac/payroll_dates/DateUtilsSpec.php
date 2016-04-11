<?php

namespace spec\davidlukac\payroll_dates;

use davidlukac\payroll_dates\DateTimeConversionException;
use davidlukac\payroll_dates\YearMonth;
use ICanBoogie\DateTime;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DateUtilsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('davidlukac\payroll_dates\DateUtils');
    }

    function it_should_convert_datetime_to_i_datetime()
    {
        $this->to_iDateTime(\DateTime::createFromFormat('Y-m-d H:i:s', '2016-12-25 23:30:30'))
            ->shouldbeLike(new DateTime("2016-12-25 23:30:30"));
    }

    function it_should_convert_datetime_to_i_date()
    {
        $this->to_iDate(\DateTime::createFromFormat("Y-m-d", "2016-11-03"))
            ->shouldBeLike(new DateTime("2016-11-03 00:00:00"));
    }

    /**
     * Following tests are not passing even if the right exception is thrown, becase PHPSpec checks for type hinting
     * in definition of the `to_iDate` method and throws its own Exception. To make these test pass, type hint needs
     * to be removed and then the function takes care of the validation and throws its own Exception.
     */

//    function it_should_throw_exception_when_converting_boolean()
//    {
//        $this->shouldThrow(
//            new DateTimeConversionException("DateTime instance must be supplied.", true)
//        )->duringTo_iDate(true);
//    }
//
//    function it_should_throw_exception_when_converting_other_class()
//    {
//        $ym = new YearMonth(2016, 04);
//        $this->shouldThrow(
//            new DateTimeConversionException("DateTime instance must be supplied.", $ym)
//        )->during("to_iDate", array($ym));
//    }
}
