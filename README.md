![Codeship Build](https://codeship.com/projects/8e674fd0-e12f-0133-2690-1e252f9b1e16/status?branch=develop)

# Payroll Dates

Simple CLI application that calculates salary and bonus dates for the following 12 months, according to these rules:

- Sales staff get a regular fixed base monthly salary, plus a monthly bonus

Output of the calculation is written into file provided as argument of the application.

## CI Tests

```
$ bin/phpspec r
$ phpunit
$ bin/behat features
```