<?php

namespace spec\davidlukac\payroll_dates;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PayrollDatesAppSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedThrough('getInstance');
        $this->shouldHaveType('davidlukac\payroll_dates\PayrollDatesApp');
    }

    function it_calculates_for_next_year()
    {
        $this->beConstructedThrough('getInstance');
        $this->calculateForNextYear()->shouldHaveKey(0);
        $this->calculateForNextYear()->shouldHaveKey(11);
        $this->calculateForNextYear()[0]->shouldBeAnInstanceOf('davidlukac\payroll_dates\SalaryMonth');
        $this->calculateForNextYear()[11]->shouldBeAnInstanceOf('davidlukac\payroll_dates\SalaryMonth');
    }
}
