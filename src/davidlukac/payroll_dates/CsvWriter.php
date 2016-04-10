<?php

namespace davidlukac\payroll_dates;

class CsvWriter
{

    /**
     * Writes array of SalaryMonth objects into provided CSV file, including the header. Overwrites any existing files.
     *
     * @param array $salaryMonths
     * @param string $fileName
     */
    public static function write($salaryMonths, $fileName)
    {
        /* @var $f resource File pointer. */
        $f = fopen($fileName, 'w');
        if ($f) {
            fputcsv($f, SalaryMonth::getCsvHeader());
            foreach ($salaryMonths as $month) {
                /* @var $month SalaryMonth */
                fputcsv($f, $month->getCsvFields());
            }
            fclose($f);
        } else {
            throw new \RuntimeException("Unable to open file.");
        }
    }

}
