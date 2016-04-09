Feature:
  As financial manager
  I want to to be able to retrieve payroll dates
  In order to pay out salaries according to business rules

Scenario Outline: Calculating salary date
  Given I provide a specific "<calendar_month>"
  Then Correct <salary_date> is calculated
  Examples:
  | calendar_month  | salary_date |
  | 2016-04         | 2016-04-29  |
