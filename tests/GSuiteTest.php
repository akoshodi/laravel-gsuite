<?php

namespace Akoshodi\GSuite\Tests;

use Akoshodi\GSuite\GSuite;
use Orchestra\Testbench\TestCase;
use Akoshodi\GSuite\GSuiteServiceProvider;
use Akoshodi\GSuite\Resources\Groups\GroupsRepository;
use Akoshodi\GSuite\Resources\Accounts\AccountsRepository;

class GSuiteTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            GSuiteServiceProvider::class
        ];
    }

    protected function getApplicationAliases($app)
    {
        return [
            GSuite::class
        ];
    }

    public function test_the_base_class_can_be_resolved()
    {
        $this->assertInstanceOf(GSuite::class, app('gsuite'));
    }

    public function test_the_base_class_can_return_the_accounts_repo()
    {
        $this->assertInstanceOf(AccountsRepository::class, app('gsuite')->accounts());
    }

    public function test_the_base_class_can_return_the_groups_repo()
    {
        $this->assertInstanceOf(GroupsRepository::class, app('gsuite')->groups());
    }
}
