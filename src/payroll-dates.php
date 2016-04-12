#!/usr/bin/env php
<?php

use davidlukac\payroll_dates\PayrollDatesApp;

require_once __DIR__ . '/../vendor/autoload.php';

$app = PayrollDatesApp::getInstance();
$app->run();
