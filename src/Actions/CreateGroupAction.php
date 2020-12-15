<?php

namespace Akoshodi\GSuite\Actions;

use Spatie\QueueableAction\QueueableAction;
use Akoshodi\GSuite\Resources\Groups\GroupsRepository;

class CreateGroupAction
{
    use QueueableAction;

    protected $repository;

    public function __construct(GroupsRepository $groups_repo)
    {
        $this->repository = $groups_repo;
    }

    public function execute(string $email, string $name = '', string $description = '')
    {
        return $this->repository->insert($email, $name, $description);
    }
}
