Feature:
  As financial manager
  I want to to be able to retrieve payroll dates
  In order to pay out salaries according to business rules

Scenario Outline: Calculating salary date
  Given I provide a specific "<calendar_month>"
  Then Correct salary date "<salary_date>" is calculated
  Then Correct bonus date "<bonus_date>" is calculated

  Examples:
  | calendar_month  | salary_date | bonus_date  |
  | 2016-04         | 2016-04-29  | 2016-05-18  |
  | 2012-12         | 2012-12-31  | 2013-01-15  |
  | 2031-08         | 2031-08-29  | 2031-09-15  |
  | 1984-03         | 1984-03-30  | 1984-04-18  |

Scenario Outline: Application output
  Given I run the application with argument calculate "<file_name>"
  Then Application writes file with the provided name

  Examples:
  | file_name   |
  | out.csv     |
  | output.csv  |
