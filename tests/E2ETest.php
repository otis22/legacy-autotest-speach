<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class E2ETest extends \PHPUnit\Framework\TestCase
{
    public function testLongScenario(): void
    {
        $driver = $this->driver();
        $driver->get('https://www.shinservice.ru/');
        $buttonTyres = $driver->findElement(
            WebDriverBy::xpath("//button[@type, 'submit' and text()='Подобрать шины']")
        );
        $buttonTyres->click();
        $driver->wait()->until(
            WebDriverExpectedCondition::titleContains('Зимние шины в Москве купить')
        );
        $toCart = $driver->findElement(
            WebDriverBy::xpath("//button[@type, 'submit' and text()='В корзину']")
        );
        $toCart->click();
        $this->fail('gg');
    }
    public function driver(): RemoteWebDriver
    {
        return  RemoteWebDriver::create("http://selenoid:4444/wd/hub", DesiredCapabilities::chrome());
    }
}
