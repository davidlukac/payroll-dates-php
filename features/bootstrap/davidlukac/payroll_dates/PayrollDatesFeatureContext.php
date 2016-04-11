<?php

namespace davidlukac\payroll_dates;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use PHPUnit_Framework_TestCase as Assertions;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Defines application features from the specific context.
 */
class PayrollDatesFeatureContext implements Context, SnippetAcceptingContext
{
    /* @var $_app PayrollDatesApp */
    private $_app;
    /* @var $_salaryMonth SalaryMonth */
    private $_salaryMonth;
    private $_fileName;
    private $_returnCode;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->_app = PayrollDatesApp::getInstance();
    }


    /**
     * @Given I provide a specific :month
     *
     * @param string $month Month in `Y-m` format from scenario outline.
     */
    public function iProvideASpecific($month)
    {
        $this->_salaryMonth = new SalaryMonth(
            YearMonth::constructWithDate(
                \DateTime::createFromFormat('Y-m', "{$month}", $this->_app->getTimeZone())
            )
        );
    }

    /**
     * @Then Correct salary date :date is calculated
     *
     * @param string $date Date in `Y-m-d` format from scenario outline.
     */
    public function correctIsCalculated($date)
    {
        Assertions::assertEquals($date, $this->_salaryMonth->getSalaryDate()->as_date);
    }

    /**
     * @Then Correct bonus date :date is calculated
     */
    public function correctBonusDateIsCalculated($date)
    {
        Assertions::assertEquals($date, $this->_salaryMonth->getBonusDate()->as_date);
    }

    /**
     * @Given I run the application with argument calculate :fileName
     *
     * @param string $fileName output file name.
     */
    public function iRunTheApplicationWithArgument($fileName)
    {
        $this->_fileName = $fileName;
        $output = new NullOutput();
        $command = $this->_app->getConsoleApp()->find(CalculateCommand::CALCULATE);
        $arguments = array(
            'command' => CalculateCommand::CALCULATE,
            'file' => $fileName,
        );
        $input = new ArrayInput($arguments);
        $this->_returnCode = $command->run($input, $output);
    }

    /**
     * @Then Application writes file with the provided name
     */
    public function applicationWritesFileWithProvidedName()
    {
        $fs = new Filesystem();
        Assertions::assertEquals(0, $this->_returnCode);
        Assertions::assertNotFalse($fs->exists($this->_fileName));
        Assertions::assertNotFalse(filesize($this->_fileName));
    }

    /**
     * Clean up testing output files.
     *
     * @AfterSuite
     */
    public static function cleanFile()
    {
        $fs = new Filesystem();
        $fs->remove("output.csv");
        $fs->remove("out.csv");
    }
}
