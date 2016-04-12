<?php

namespace davidlukac\payroll_dates;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CalculateCommand defines console application command 'calculate', which run core application functionality.
 *
 * @package davidlukac\payroll_dates
 */
class CalculateCommand extends Command
{
    // Command name.
    const CALCULATE = 'calculate';
    // Command argument name.
    private $_argFileName = 'file';

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        // Set command properties and arguments.
        $this->setName(static::CALCULATE);
        $this->setDescription("Calculates salary and bonus dates for the next 12 months.");
        $this->addArgument($this->_argFileName, InputArgument::REQUIRED, "Output file (required).");
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Actual command execution.
        // Get filename argument.
        $outputFileName = $input->getArgument($this->_argFileName);

        // Check if filename was provided.
        if (empty($outputFileName)) {
            throw new \InvalidArgumentException("Filename was not set.");
        }

        // Run calculation and save the result.
        /* @var $app PayrollDatesApp */
        $app = $this->getApplication();
        $result = $app->calculateForNextYear();

        // Write result to console if verbose level was set.
        if ($output->getVerbosity() > OutputInterface::VERBOSITY_NORMAL) {
            foreach ($result as $month) {
                printf($month . "\n");
            }
        }

        // Write result to the file.
        CsvWriter::write($result, $outputFileName);
    }

}
