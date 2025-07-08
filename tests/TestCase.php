<?php

namespace Elcomware\CrudMaster\Tests;

use Elcomware\CrudMaster\CrudMasterServiceProvider;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    use WithWorkbench;

    //use RefreshDatabase;
    //use DatabaseTransactions;
    //

    protected $enablesPackageDiscoveries = true;



    /*protected function getPackageProviders($app)
    {
        return [
            CrudMasterServiceProvider::class,
        ];
    }*/
}



