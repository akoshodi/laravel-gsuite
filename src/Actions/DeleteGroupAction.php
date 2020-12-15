<?php

namespace Akoshodi\GSuite\Actions;

use Spatie\QueueableAction\QueueableAction;
use Akoshodi\GSuite\Resources\Groups\GroupsRepository;

class DeleteGroupAction
{
    use QueueableAction;

    protected $repository;

    public function __construct(GroupsRepository $groups_repo)
    {
        $this->repository = $groups_repo;
    }

    public function execute(string $email)
    {
        return $this->repository->delete($email);
    }
}
