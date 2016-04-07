<?php

use davidlukac\payroll_dates\PayrollDatesApp;

require_once __DIR__ . '/../vendor/autoload.php';

echo("Running Payroll Dates application.\n");

// Suppress DateTime warnings.
date_default_timezone_set(@date_default_timezone_get());

$app = PayrollDatesApp::getInstance();
$app->calculate();
echo("Shutting down...\n");
