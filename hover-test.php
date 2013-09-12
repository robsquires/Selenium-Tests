<?php

require "./vendor/facebook/webdriver/lib/__init__.php";


$host = 'http://localhost:8910/wd/hub'; // this is the default
$capabilities = array(WebDriverCapabilityType::BROWSER_NAME => 'phantomjs');
$driver = new RemoteWebDriver($host, $capabilities);

$driver->get("http://localhost/projects/Squirrel/selenium-tests/test.html");


$by = WebDriverBy::id('parent');

$el = $driver->findElement($by);


$driver->getMouse()->mouseMove($el->getCoordinates());


//$driver->takeScreenshot('shot.jpg');



// $driver->close();