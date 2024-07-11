<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Mockery;

abstract class TestCase extends BaseTestCase
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        return self::initialize();
    }

    private static $configurationApp = null;
    public static function initialize(){

        if(is_null(self::$configurationApp)){
            $app = require __DIR__.'/../bootstrap/app.php';

            $app->loadEnvironmentFrom('.env.testing');

            $app->make(Kernel::class)->bootstrap();

            if (config('database.default') == 'sqlite') {
                $db = app()->make('db');
                $db->connection()->getPdo()->exec("pragma foreign_keys=1");
            }

            Artisan::call('migrate:fresh --seed');
//            Artisan::call('db:seed');

            self::$configurationApp = $app;
            return $app;
        }

        return self::$configurationApp;
    }

    public function tearDown(): void
    {
        if ($this->app) {
            foreach ($this->beforeApplicationDestroyedCallbacks as $callback) {
                call_user_func($callback);
            }

        }

        $this->setUpHasRun = false;

        if (property_exists($this, 'serverVariables')) {
            $this->serverVariables = [];
        }

        if (class_exists('Mockery')) {
            Mockery::close();
        }

        $this->afterApplicationCreatedCallbacks = [];
        $this->beforeApplicationDestroyedCallbacks = [];

        if (self::$applicationRefreshed) {
            self::$applicationRefreshed = false;
            $this->app->flush();
            $this->app = null;
            self::$configurationApp = null;
        }
    }

    protected static $applicationRefreshed = false;

    /**
     * Refresh the application instance.
     *
     * @return void
     */
    protected function forceRefreshApplication() {
        if (!is_null($this->app)) {
            $this->app->flush();
        }
        $this->app = null;
        self::$configurationApp = null;
        self::$applicationRefreshed = true;
        parent::refreshApplication();
    }
}
