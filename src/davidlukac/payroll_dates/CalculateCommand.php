<?php

namespace davidlukac\payroll_dates;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CalculateCommand extends Command
{
    private $_cmdCalculateName = "calculate";
    private $_argFileName = 'file';

    protected function configure()
    {
        $this->setName($this->_cmdCalculateName);
        $this->setDescription("Calculates salary and bonus dates for the next 12 months.");
        $this->addArgument($this->_argFileName, InputArgument::REQUIRED, "Output file (required).");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $app = PayrollDatesApp::getInstance();
        $result = $app->calculateForNextYear();
        $outputFileName = $input->getArgument($this->_argFileName);

        if (empty($outputFileName)) {
            throw new \InvalidArgumentException("Filename was not set.");
        }

        // @todo Write result to file.

        if ($output->getVerbosity() > OutputInterface::VERBOSITY_NORMAL) {
            foreach ($result as $month) {
                printf($month . "\n");
            }
        }

    }

}
