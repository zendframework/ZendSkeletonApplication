Feature: Application Index
  In order to see the application index
  As an anonymous user
  I need to be able to load the application homepage

Scenario: Load the homepage
  Given I am on the homepage
  Then the response status code should be 200
  And I should see "Welcome to Zend Framework 2"
