<?php

namespace Akoshodi\GSuite;

use Akoshodi\GSuite\Clients\GoogleServicesClient;
use Akoshodi\GSuite\Resources\Groups\GroupsRepository;
use Akoshodi\GSuite\Resources\Accounts\AccountsRepository;

class GSuite
{
    /**
     * @see GroupsRepository
     */
    protected $groups_repo;

    /**
     * @see AccountsRepository
     */
    protected $accounts_repo;

    public function __construct(GroupsRepository $groups_repo, AccountsRepository $accounts_repo)
    {
        $this->groups_repo = $groups_repo;

        $this->accounts_repo = $accounts_repo;

        return $this;
    }

    public function accounts()
    {
        return $this->accounts_repo;
    }

    public function groups()
    {
        return $this->groups_repo;
    }

    /**
     * return void
     */
    public function flushCache()
    {
        $this->groups()->flushCache();

        $this->accounts()->flushCache();

        return $this;
    }
}
