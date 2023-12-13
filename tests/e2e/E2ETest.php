<?php

namespace Otis22\BeerMeetup\e2e;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;

class E2ETest extends \PHPUnit\Framework\TestCase
{
    private RemoteWebDriver $driver;
    public function setUp(): void
    {
        $options = new ChromeOptions();
        $options->addArguments(['--window-size=1920,1080', ]);
        $caps = DesiredCapabilities::chrome();
        $caps->setCapability('version', "112.0");
        $caps->setCapability('browserName', "chrome");
        $caps->setCapability('enableVNC', true);
        $caps->setCapability(ChromeOptions::CAPABILITY, $options);

        $this->driver = RemoteWebDriver::create("http://selenoid:4444/wd/hub/", $caps);
    }
    public function tearDown(): void
    {
        $this->driver->quit();
    }
    public function testSearchTyresAndMakeOrder(): void
    {
        $this->driver->get('https://www.shinservice.ru/');
        sleep(3);
        $this->driver->findElement(
            WebDriverBy::xpath("//button[@type='submit' and text()='Подобрать шины']")
        )->click();
        sleep(3);
        $this->driver->findElement(WebDriverBy::xpath("//button[text()='В корзину']"))->click();
        sleep(3);
        $this->driver->findElement(WebDriverBy::xpath("//button[text()='Оформить']"))->click();
        sleep(3);
        $this->driver->findElement(
            WebDriverBy::xpath("//button[text()='Перейти к оформлению']")
        )->click();
        sleep(3);
        $this->driver->findElement(
            WebDriverBy::xpath("//p[text()='Андропова проспект']")
        )->click();
        sleep(1);
        $this->driver->findElement(WebDriverBy::xpath("//button[text()='Заберу отсюда']"))->click();
        $this->assertNotCount(
            0,
            $this->driver->findElements(WebDriverBy::xpath('//*[contains(text(),"Способ оплаты")]'))
        );
    }
}
