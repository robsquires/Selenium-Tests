<?php

use Behat\MinkExtension\Context\MinkContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;


/**
 * Features context.
 */
class FeatureContext extends MinkContext
{
    /**
     * @When /^I hover over the element "([^"]*)"$/
     */
    public function iHoverOverTheElement($css)
    {

        $el = $this
            ->getSession()
            ->getPage()
            ->find('css', $css)
        ;

        $el->mouseOver();
    }

    /**
     * Take screenshot when step fails. Works only with Selenium2Driver.
     * Screenshot is saved at [Date]/[Feature]/[Scenario]/[Step].jpg
     *
     * @AfterStep
     */
    public function takeScreenshotAfterFailedStep(\Behat\Behat\Event\StepEvent $event)
    {
        $driver = $this
            ->getSession()
            ->getDriver()
        ;

        if ($event->getResult() === \Behat\Behat\Event\StepEvent::FAILED) {

            if ($driver instanceof \Behat\Mink\Driver\Selenium2Driver) {
                $step = $event->getStep();
                $path = array(
                    'date' => date("Ymd-Hi"),
                    'feature' => $step->getParent()->getFeature()->getTitle(),
                    'scenario' => $step->getParent()->getTitle(),
                    'step' => $step->getType() . ' ' . $step->getText()
                );
                $path = preg_replace('/[^\-\.\w]/', '_', $path);
                $filename = './screenshots/' .  implode('/', $path) . '.jpg';

                // Create directories if needed
                if (!@is_dir(dirname($filename))) {
                    @mkdir(dirname($filename), 0775, TRUE);
                }

                file_put_contents($filename, $driver->getScreenshot());
            }
        }
    }

}
