<?php

namespace spec\davidlukac\payroll_dates;

use davidlukac\payroll_dates\PayrollDatesApp;
use PhpSpec\ObjectBehavior;

abstract class PayrollDatesAppBehaviour extends ObjectBehavior
{

    /* @var $appContext PayrollDatesApp */
    protected $_appContext;

    public function __construct()
    {
        $this->_appContext = PayrollDatesApp::getInstance();
    }

}
