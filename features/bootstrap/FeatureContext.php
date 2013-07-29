<?php

use Behat\Behat\Context\BehatContext;
use Behat\Gherkin\Node\PyStringNode;

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    protected $path = '';

    protected $page = '';

    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }

    /**
     * @Given /^I am in path "([^"]*)"$/
     */
    public function iAmInPath($path)
    {
        $this->path = 'http://localhost:8888' . $path;
    }

    /**
     * @When /^I load the page$/
     */
    public function iLoadThePage()
    {
        $this->page = file_get_contents($this->path);
    }

    /**
     * @Then /^I should see:$/
     */
    public function iShouldSee(PyStringNode $string)
    {
        if (! strpos($this->page, (string) $string)) {
            throw new Exception("Actual page is:\n" . $this->page);
        }
    }
}
