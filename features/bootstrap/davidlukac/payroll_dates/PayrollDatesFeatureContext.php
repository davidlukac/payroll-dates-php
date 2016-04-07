<?php

namespace davidlukac\payroll_dates;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

/**
 * Defines application features from the specific context.
 */
class PayrollDatesFeatureContext implements Context, SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }


    /**
     * @Given I provide a specific :calendar_month
     */
    public function iProvideASpecific($calendar_month)
    {
        $sm = new SalaryMonth($calendar_month);
    }

    /**
     * @Then Correct :arg1-:arg2-:arg3 is calculated
     */
    public function correctIsCalculated($arg1, $arg2, $arg3)
    {
        throw new PendingException();
    }
}
