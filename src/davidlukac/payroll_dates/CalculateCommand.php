<?php

namespace davidlukac\payroll_dates;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CalculateCommand extends Command
{
    private $_argCalculateName = "calculate";

    protected function configure()
    {
        $this->setName($this->_argCalculateName);
        $this->setDescription("Calculates salary and bonus dates for the next 12 months.");
        $this->addArgument('file', InputArgument::REQUIRED, "Output file.");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $app = PayrollDatesApp::getInstance();
        $result = $app->calculateForNextYear();
        $outputFileName = $input->getArgument($this->_argCalculateName);

        if (empty($outputFileName)) {
            throw new \InvalidArgumentException("Filename was not set.");
        }

        // @todo Write result to file.
    }

}
