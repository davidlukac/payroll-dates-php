<?php

namespace spec\davidlukac\payroll_dates;

use davidlukac\payroll_dates\DateTimeConversionException;
use davidlukac\payroll_dates\YearMonth;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DateTimeConversionExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith("Exception message", new \DateTime("now"));
        $this->shouldHaveType('davidlukac\payroll_dates\DateTimeConversionException');
    }

    function it_should_include_simle_type()
    {
        $this->beConstructedWith("Exception message.", TRUE);
        $this->getMessage()->shouldBe("Exception message. Was: boolean.");
    }

    function it_should_include_complex_type()
    {
        $this->beConstructedWith("Exception message.", new YearMonth(2016, 4));
        $this->getMessage()->shouldBe("Exception message. Was: davidlukac\\payroll_dates\\YearMonth.");
    }
}
