<?php

namespace Akoshodi\GSuite\Actions;

use Spatie\QueueableAction\QueueableAction;
use Akoshodi\GSuite\Resources\Accounts\AccountsRepository;

class SuspendAccountAction
{
    use QueueableAction;

    protected $repository;

    public function __construct(AccountsRepository $accounts_repo)
    {
        $this->repository = $accounts_repo;
    }

    public function execute(string $userKey)
    {
        return $this->repository->suspend($userKey);
    }
}
