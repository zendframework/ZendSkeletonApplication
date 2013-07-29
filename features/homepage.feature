Feature: Application Index
  In order to see the application index
  As an anonymous user
  I need to be able to load the application homepage

Scenario: Load the homepage
  Given I am in path "/"
  When I load the page
  Then I should see:
    """
    Welcome to <span class="zf-green">Zend Framework 2</span>
    """