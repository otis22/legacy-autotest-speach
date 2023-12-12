<?php

namespace Otis22\BeerMeetup\e2e;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\Chrome\ChromeOptions;

class E2ETest extends \PHPUnit\Framework\TestCase
{
    public function testLongScenario(): void
    {
        $driver = $this->driver();
        $driver->get('https://www.shinservice.ru/');
        sleep(3);
        $driver->findElement(
            WebDriverBy::xpath("//button[@type='submit' and text()='Подобрать шины']")
        )->click();
        sleep(3);
        $driver->findElement(
            WebDriverBy::xpath("//button[text()='В корзину']")
        )->click();
        sleep(3);
        $driver->findElement(
            WebDriverBy::xpath("//button[text()='Оформить']")
        )->click();
        sleep(3);
        $driver->findElement(
            WebDriverBy::xpath("//button[text()='Перейти к оформлению']")
        )->click();
        sleep(3);
        $driver->findElement(
            WebDriverBy::xpath("//p[text()='Андропова проспект']")
        )->click();
        sleep(1);
        $driver->findElement(
            WebDriverBy::xpath("//button[text()='Заберу отсюда']")
        )->click();
        $this->fail('gg');

    }

    public function driver(): RemoteWebDriver
    {
        $options = new ChromeOptions();
        $options->addArguments(array(
            '--window-size=1920,1080',
        ));
        $caps = DesiredCapabilities::chrome();
        $caps->setCapability('version', "112.0");
        $caps->setCapability('browserName', "chrome");
        $caps->setCapability('enableVNC', true);
        $caps->setCapability(ChromeOptions::CAPABILITY, $options);

        $driver = RemoteWebDriver::create("http://selenoid:4444/wd/hub/", $caps);
        $driver->manage()->timeouts()->implicitlyWait(10);
        return $driver;
    }
}
