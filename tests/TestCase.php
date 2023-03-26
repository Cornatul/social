<?php

namespace Cornatul\Social\Tests;
use Cornatul\News\NewsServiceProvider;
use Cornatul\Social\SocialServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
class TestCase extends OrchestraTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    final protected function getPackageProviders($app)
    {
        return [
            SocialServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
