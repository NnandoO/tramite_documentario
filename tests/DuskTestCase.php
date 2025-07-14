<?php

namespace Tests;

use Illuminate\Foundation\Testing\DuskTestCase as BaseTestCase;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

abstract class DuskTestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function driver(): RemoteWebDriver
    {
        $options = (new ChromeOptions())->addArguments([
            '--disable-gpu',
            '--headless',
            '--window-size=1920,1080',
        ]);

        return RemoteWebDriver::create(
            'http://localhost:9515',
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY,
                $options
            )
        );
    }
}
