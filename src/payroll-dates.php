#!/usr/bin/env php
<?php

use davidlukac\payroll_dates\CalculateCommand;
use Symfony\Component\Console\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$consoleApp = new Application();
$consoleApp->setName("Payroll Dates Calculator");
$consoleApp->setVersion("v0.1.0");
$consoleApp->add(new CalculateCommand());
$consoleApp->run();
